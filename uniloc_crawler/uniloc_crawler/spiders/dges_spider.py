import scrapy
from scrapy.crawler import CrawlerProcess
import mysql.connector
import logging


# Informações dos municipios
class InformaçãoMunicipio_Spider(scrapy.Spider):

    name = "inf_mun"

    start_urls = [
        'https://www.pordata.pt/Municipios/Quadro+Resumo/Abrantes-255786'
    ]

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.InformaçãoMunicipiosPipeline': 400
        }
    }

    base_link = 'https://www.pordata.pt/Municipios/Quadro+Resumo/'

    def parse(self, response):

        for option in response.css('option'):

            municipio = option.css('option::text').get()
            codigo = option.css('option::attr(value)').get()

            cid_cod = municipio + "-" + codigo

            link = self.base_link + cid_cod

            yield scrapy.Request(url=link, callback=self.parse_cidade, meta={'municipio': municipio})

    def parse_cidade(self, response):

        municipio = response.request.meta['municipio']
        index = 1

        inf = dict()
        inf['municipio_nome'] = municipio

        if inf['municipio_nome'] is None:
            return

        for reg in response.css('#QrTable tr'):

            try:
                indicador = response.xpath(
                    '//*[@id="QrTable"]/tbody/tr['+str(index)+']/td[1]/div[2]/a/text()').extract()[0]
                valor = response.xpath(
                    '//*[@id="QrTable"]/tbody/tr['+str(index)+']/td[11]/text()').extract()[0]
            except:
                continue

            # Porque estamos a sacar os indicadores do ciclo foreach e o valor de um offset de uma lista, temos um bug onde um indicador se duplica
            # Isto causa que os valores - indicadores estajam desalinhados por 1
            if indicador is None:
                continue

            inf[indicador] = valor

            index += 1

        yield inf


# Lista de instituições e os seus respetivos cursos Old
class dgesSpider(scrapy.Spider):
    #
    #   ESTE SCRIPT NÃO CORRESPONDE A NENHUMA TABELA
    #
    name = "cur_inst_old"

    start_urls = [
        'https://dges.gov.pt/guias/indest.asp?reg=11',
        'https://dges.gov.pt/guias/indest.asp?reg=12',
        'https://dges.gov.pt/guias/indest.asp?reg=13',
        'https://dges.gov.pt/guias/indest.asp?reg=21',
        'https://dges.gov.pt/guias/indest.asp?reg=22'

    ]

    def parse(self, response):
        # .box9 é a classe que engloba os titulos de instituições
        for post in response.css('.box9'):

            # Por cada instituição, criamos um dicionario para todos os seus cursos
            cursos = list()

            # seletor css para o proximo irmão (sibling)
            concat = " + .lin-ce "

            # Sintetizamos um bloco do while
            # curso['nome'] = post.css('.box9 '+concat+' a::text' ).get()
            # cursos.append(curso)
            # concat = concat + " + .lin-ce "

            while(post.css('.box9 ' + concat).get() is not None):
                curso = dict()
                curso['cod'] = post.css(
                    '.box9 '+concat+' .lin-ce-c2::text').get()
                curso['nome'] = post.css(
                    '.box9 '+concat+' .lin-ce-c3 a::text').get()

                cursos.append(curso)
                concat = concat + " + .lin-ce "

            yield {
                'cod': post.css('div::text')[0].get(),
                'nome': post.css('div::text')[1].get(),
                'cod_tipo': response.url[-2:],
                'cursos': cursos
            }

# Popular a tabela instituições
class instCrawler(scrapy.Spider):

    name = "insts"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.InstituicoesPipeline': 400
        }
    }

    start_urls = [
        'https://dges.gov.pt/guias/indest.asp?reg=11',
        'https://dges.gov.pt/guias/indest.asp?reg=12',
        'https://dges.gov.pt/guias/indest.asp?reg=13',
        'https://dges.gov.pt/guias/indest.asp?reg=21',
        'https://dges.gov.pt/guias/indest.asp?reg=22'

    ]

    # 11 - Ensino Superior Público Universitário
    # 12 - Ensino Superior Público Politécnico
    # 13 - Ensino Superior Público Militar e Policial
    # 21 - Ensino Superior Privado Universitário
    # 22 - Ensino Superior Privado Universitário

    def parse(self, response):
        # .box9 é a classe que engloba os titulos de instituições
        for div in response.css('.box9'):
            cod = div.css('div::text')[0].get()
            nome = div.css('div::text')[1].get()
            cod_tipo = response.url[-2:]
            link = response.urljoin(
                div.css('.box9 + div .lin-ce-c3 a::attr(href)').get())
            yield scrapy.Request(url=link, callback=self.parse_codigo, meta={'cod': cod, 'nome': nome, 'cod_tipo': cod_tipo})

    async def parse_codigo(self, response):
        cod = response.request.meta['cod']
        nome = response.request.meta['nome']
        cod_tipo = response.request.meta['cod_tipo']
        cod_postal = await self.get_cod(response.xpath("/html/body/div[2]/div/div/div/div/div/div[2]/div/div[5]/text()").extract())
        yield {
            'cod': cod,
            'nome': nome,
            'cod_tipo': cod_tipo,
            'cod_postal': cod_postal
        }

    async def get_cod(self, lista):

        cod_postal = 0000
        for item in lista:
            candt = item[:4]
            if candt.isnumeric():
                cod_postal = candt
                break
        return cod_postal


# Popular a tabela cursos
class cursoCrawler(scrapy.Spider):
    name = "cursos_deprecated"

    start_urls = [
        'https://dges.gov.pt/guias/indcurso.asp?letra=A',
    ]

    def next_alpha(self, s):
        return chr((ord(s.upper())+1 - 65) % 26 + 65)

    def parse(self, response):
        # .box9 é a classe que engloba os titulos de instituições
        for post in response.css('.box10'):
            yield {
                'cod': post.css('div::text')[0].get(),
                'nome': post.css('div::text')[1].get(),
            }

        next = response.request.url[-1]  # Mudamos um A para o B
        link = "https://dges.gov.pt/guias/indcurso.asp?letra=" + \
            self.next_alpha(next)
        if next:
            yield scrapy.Request(url=link, callback=self.parse)

# Popular a tabela associativa inst_curso
class inst_cursoCrawler(scrapy.Spider):
    name = "inst_curso"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.Inst_CursosPipeline': 400
        }
    }

    start_urls = [
        'https://dges.gov.pt/guias/indest.asp?reg=11',
        'https://dges.gov.pt/guias/indest.asp?reg=12',
        'https://dges.gov.pt/guias/indest.asp?reg=13',
        'https://dges.gov.pt/guias/indest.asp?reg=21',
        'https://dges.gov.pt/guias/indest.asp?reg=22'

    ]

    def parse(self, response):
        # .box9 é a classe que engloba os titulos de instituições
        for post in response.css('.box9'):

            cod_inst = post.css('div::text')[0].get()

            # seletor css para o proximo irmão (sibling)
            concat = " + .lin-ce "
            while(post.css('.box9 ' + concat).get() is not None):
                cod_curso = post.css('.box9 '+concat+' .lin-ce-c2::text').get()

                link = response.urljoin(
                    post.css('.box9 '+concat+' .lin-ce-c3 a::attr(href)').get())
                yield scrapy.Request(url=link, callback=self.parse_ult, meta={'curso': cod_curso, 'inst': cod_inst})

                concat = concat + " + .lin-ce "

    def parse_ult(self, response):
        curso = response.request.meta['curso']
        inst = response.request.meta['inst']

        try:
            notas = response.css(".body10a .tvag::text").getall()
            if notas[len(notas)-2] is not None and notas[len(notas)-2] != '\xa0':
                nota_ult_ER = notas[len(notas)-1]
            else:
                nota_ult_ER = "Informação não disponível"

            if notas[len(notas)-1] is not None and notas[len(notas)-1] != '\xa0':
                nota_ult_EN = notas[len(notas)-2]
            else:
                nota_ult_EN = "Informação não disponível"
            yield{
                'curso': curso,
                'inst': inst,
                'nota_ult_EN': nota_ult_EN,
                'nota_ult_ER': nota_ult_ER
            }
        except:
            yield{
                'curso': curso,
                'inst': inst,
                'nota_ult_EN': "Informação não disponível",
                'nota_ult_ER': "Informação não disponível"
            }

# Popular a tabela distritos
class distCrawler(scrapy.Spider):
    name = "dist"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.DistritosPipeline': 400
        }
    }

    start_urls = [
        'http://pt.gpspostcode.com/codigo-postal/portugal/#111'
    ]

    def parse(self, response):

        for row in response.css('.table_milieu tr'):
            yield {
                'nome': row.css("a::text").get(),
                'id': row.css("td.gras::text").get()
            }


class cod_postCrawler(scrapy.Spider):
    name = "cod_post"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.CodPostaisPipeline': 400
        }
    }

    start_urls = [
        'http://pt.gpspostcode.com/codigo-postal/portugal/#111'
    ]

    def parse(self, response):

        for row in response.css('.table_milieu tr'):
            if row.css("a::attr(href)").get():
                link = response.urljoin(row.css("a::attr(href)").get())
                yield scrapy.Request(url=link, callback=self.parse_municipio)

    def parse_municipio(self, response):

        for row in response.css('.table_milieu tr '):

            uri = row.css("a::attr(href)").get()    # tentar arranjar o URI

            if uri is None:  # se o uri não existir, também não existe uma coluna para o código do municipio válido
                continue

            cod_municipio = row.css('.gras::text').get()

            link = response.urljoin(uri)

            yield scrapy.Request(url=link, callback=self.parse_cidade, meta={'id_municipio': cod_municipio})

    def parse_cidade(self, response):

        cod_municipio = response.request.meta['id_municipio']

        for x in response.xpath("/html/body/table/tr"):

            campos = x.css('td::text').getall()

            if len(campos) < 3:  # significa que estamos perante table headers
                continue

            yield{
                'cidade': campos[2],
                'codigo_postal': campos[1],
                'cod_municipio': cod_municipio.strip()
            }


class apartadoCrawler(scrapy.Spider):
    name = "apart"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.ApartadosPipeline': 400
        }
    }

    start_urls = [
        'https://www.codigo-postal.pt/?cp4=1049&cp3='
    ]

    def parse(self, response):
        mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="projeto_final"
        )

        cursor = mydb.cursor()

        cursor.execute("SELECT DISTINCT instituicoes.cod_postal FROM instituicoes WHERE instituicoes.cod_postal NOT IN (SELECT DISTINCT codigos_postais.cod_postal FROM codigos_postais)")

        cod_list = cursor.fetchall()

        for item in cod_list:
            cod = ''.join(filter(str.isdigit, str(item)))
            link = "https://www.codigo-postal.pt/?cp4="+cod+"&cp3="
            yield scrapy.Request(url=link, callback=self.parse_cod,  meta={'cod': cod})

    def parse_cod(self, response):
        cod = response.request.meta['cod']
        yield{
            'nome': response.xpath('/html/body/div[4]/div/div/div[1]/div/p[3]/span[2]/text()[3]').extract(),
            'cod': cod
        }


class municipiosCrawler(scrapy.Spider):

    name = "municipios"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.MunicipiosPipeline': 400
        }
    }

    start_urls = [
        'http://pt.gpspostcode.com/codigo-postal/portugal/#111'
    ]

    def parse(self, response):

        for row in response.css('.table_milieu tr'):
            if row.css("a::attr(href)").get():
                link = response.urljoin(row.css("a::attr(href)").get())
                yield scrapy.Request(url=link, callback=self.parse_municipio)

    def parse_municipio(self, response):

        # O penultimo e ante-penultimo caracter
        dist_cod = response.css("h1::text").get()[-3:-1]
        for row in response.css('.table_milieu tr '):

            municipio_nome = row.css("a::text").get()

            if municipio_nome is None:
                continue

            cod_municipio = row.css('.gras::text').get()

            yield{
                'nome': municipio_nome,
                'mun_id': cod_municipio,
                'dist_id': dist_cod
            }


class cidadesCrawler(scrapy.Spider):
    name = "cidades"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.CidadesPipeline': 400
        }
    }

    start_urls = [
        'http://pt.gpspostcode.com/codigo-postal/portugal/#111'
    ]

    def parse(self, response):

        for row in response.css('.table_milieu tr'):
            if row.css("a::attr(href)").get():
                link = response.urljoin(row.css("a::attr(href)").get())
                yield scrapy.Request(url=link, callback=self.parse_municipio)

    def parse_municipio(self, response):

        for row in response.css('.table_milieu tr '):

            uri = row.css("a::attr(href)").get()    # tentar arranjar o URI

            if uri is None:  # se o uri não existir, também não existe uma coluna para o código do municipio válido
                continue

            cod_municipio = row.css('.gras::text').get()

            link = response.urljoin(uri)

            yield scrapy.Request(url=link, callback=self.parse_cidade, meta={'id_municipio': cod_municipio})

    def parse_cidade(self, response):

        cod_municipio = response.request.meta['id_municipio']

        for x in response.xpath("/html/body/table/tr"):

            campos = x.css('td::text').getall()

            if len(campos) < 3:  # significa que estamos perante table headers
                continue

            yield{
                'cidade': campos[2],
                # 'codigo_postal' : campos[1],
                'cod_municipio': cod_municipio
            }


class rankingCrawler(scrapy.Spider):
    name = "rank"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.RankPipeline': 400
        }
    }

    start_urls = [
        'https://www.4icu.org/pt/'
    ]

    def parse(self, response):
        for row in response.css('.table-hover tr'):
            yield {
                'rank': row.css("b::text").get(),
                'nome': row.css("a::text").get()
            }


class areaCrawler(scrapy.Spider):
    name = "area"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.AreaPipeline': 400
        }
    }

    start_urls = [
        'https://www.dges.gov.pt/guias/indarea.asp?area=14'
    ]

    def parse(self, response):
        # iterar sobre os elementos HTML que contém as áreas
        for row in response.css('.areas'):
             # a informação pode estar dentro de <a> tags                               
            if row.css("a::text"):                                     
                yield {
                     # fazer slicing nos ultimos dois caracteres do link para obter o código
                    'codigo': row.css("a::attr(href)").get()[-2:],
                     # armazenar o texto dentro do <a> tag para obter o nome da área         
                    'nome': row.css("a::text").get()                       
                }
                # ou pode estar dentro de <strong> tags
            elif row.css("strong::text"):                               
                yield {
                    # para obter o código selecionamos os ultimos dois caracteres do link atual que está selecionado pelo kernel da framework
                    'codigo': response.url[-2:],
                    # para obter o nome da area retirar o texto da tag atual                            
                    'nome': row.css("strong::text").get()                   
                }


class cursosCrawler(scrapy.Spider):
    name = "cursos"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.CursosPipeline': 400
        }
    }

    start_urls = [
        'https://www.dges.gov.pt/guias/indarea.asp?area=14'
    ]

    def parse(self, response):

        try:
            index = response.request.meta['index']
        except:
            index = -1

        for row in response.css('.lin-area'):
            cod = row.css(" .lin-area-c1::text").get()
            curso = row.css(" a::text").get()
            cod_area = response.request.url[-2:]

            yield{
                'cod': cod,
                'curso': curso,
                'cod_area': cod_area,

            }

        index += 1
        links = response.css('.areas a::attr(href)').getall()
        link = response.urljoin(links[index])

        yield response.follow(url=link, callback=self.parse, meta={'index': index})

# process = CrawlerProcess()
# ## Popular instituições
# process.crawl(instCrawler)
# process.start() # the script will block here until all crawling jobs are finished

# ## Popular cursos
# process.crawl(cursoCrawler)
# process.start() # the script will block here until all crawling jobs are finished

# ## Popular tabela associativa
# process.crawl(cursoCrawler)
# process.start() # the script will block here until all crawling jobs are finished


class Provas_IngressoCrawler(scrapy.Spider):
    name = "prov_ing"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.Provas_IngressoPipeline': 400
        }
    }

    start_urls = [
        'https://dges.gov.pt/guias/indest.asp?reg=11',
        'https://dges.gov.pt/guias/indest.asp?reg=12',
        'https://dges.gov.pt/guias/indest.asp?reg=13',
        'https://dges.gov.pt/guias/indest.asp?reg=21',
        'https://dges.gov.pt/guias/indest.asp?reg=22'

    ]

    def parse(self, response):
        # .box9 é a classe que engloba os titulos de instituições
        for post in response.css('.box9'):

            cod_inst = post.css('div::text')[0].get()

            # seletor css para o proximo irmão (sibling)
            concat = " + .lin-ce "
            while(post.css('.box9 ' + concat).get() is not None):
                cod_curso = post.css('.box9 '+concat+' .lin-ce-c2::text').get()

                link = response.urljoin(
                    post.css('.box9 '+concat+' .lin-ce-c3 a::attr(href)').get())
                yield scrapy.Request(url=link, callback=self.parse_provas_ingresso, meta={'curso': cod_curso, 'inst': cod_inst})

                concat = concat + " + .lin-ce "

    def parse_provas_ingresso(self, response):
        curso = response.request.meta['curso']  # codigo curso
        inst = response.request.meta['inst']    # codigo inst

        info = response.xpath(
            "//*[@id='caixa-orange']/div[5]/text()").extract()

      
        exames_curso = list()

        exames_lista = [
            'Alemão',
            'Biologia e Geologia',
            'Desenho',
            'Economia',
            'Espanhol',
            'Filosofia',
            'Física e Química',
            'Francês',
            'Geografia',
            'Geometria Descritiva',
            'História',
            'Hist. da Cultura e Artes',
            'Inglês',
            'Latim',
            'Literatura Portuguesa',
            'Matemática',
            'Mat. Apl. Ciências Soc.',
            'Português',
            'Matemática A',
        ]

        exames = list()

        uma_das_seguintes_provas_keyword = False


        if 'Uma das seguintes provas:' in info:
            uma_das_seguintes_provas_keyword = True

       

        
        if uma_das_seguintes_provas_keyword:
            for x in info:
                if x[4:] in exames_lista:
                    exames.append(x[:2])
                    yield{
                        'curso_id' : curso,
                        'inst_id' : inst,
                        'exames' : str(exames).replace('[', '').replace("'", '').replace("]",'').replace(" ", ""),   # remover pelicas, espaços e paratises retos
                        'opção' : uma_das_seguintes_provas_keyword
                    }
                    exames.clear()
        else: # contem as keyword "Um dos seguintes conjuntos" ex: https://www.dges.gov.pt/guias/detcursopi.asp?codc=9500&code=4108
            for x in info:
                
                if x[4:] in exames_lista:
                    exames.append(x[:2])
                if x == '\xa0\xa0\xa0\xa0\xa0\xa0ou':
                    yield{
                        'curso_id' : curso,
                        'inst_id' : inst,
                        'exames' : str(exames).replace('[', '').replace("'", '').replace("]",'').replace(" ", ""),   # remover pelicas, espaços e paratises retos
                        'opção' : uma_das_seguintes_provas_keyword
                    }
                    exames.clear()
                    
            if exames:
                yield{
                    'curso_id' : curso,
                    'inst_id' : inst,
                    'exames' : str(exames).replace('[', '').replace("'", '').replace("]",'').replace(" ", ""),   # remover pelicas, espaços e paratises retos
                    'opção' : uma_das_seguintes_provas_keyword
                }
                exames.clear()

# Populacionar as coordenadas na tabela instituições
class coordenadas_patch(scrapy.Spider):

    name = "coord_patch"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.coordenadas_patchPipeline': 400
        }
    }

    start_urls = [
        'https://dges.gov.pt/guias/indest.asp?reg=11',
        'https://dges.gov.pt/guias/indest.asp?reg=12',
        'https://dges.gov.pt/guias/indest.asp?reg=13',
        'https://dges.gov.pt/guias/indest.asp?reg=21',
        'https://dges.gov.pt/guias/indest.asp?reg=22'

    ]

    # 11 - Ensino Superior Público Universitário
    # 12 - Ensino Superior Público Politécnico
    # 13 - Ensino Superior Público Militar e Policial
    # 21 - Ensino Superior Privado Universitário
    # 22 - Ensino Superior Privado Universitário

    def parse(self, response):
        # .box9 é a classe que engloba os titulos de instituições
        for div in response.css('.box9'):
            cod = div.css('div::text')[0].get()
            nome = div.css('div::text')[1].get()
            cod_tipo = response.url[-2:]
            link = response.urljoin(
                div.css('.box9 + div .lin-ce-c3 a::attr(href)').get())
            yield scrapy.Request(url=link, callback=self.parse_codigo, meta={'cod': cod, 'nome': nome, 'cod_tipo': cod_tipo})

    async def parse_codigo(self, response):
        cod = response.request.meta['cod']
        link = response.xpath("//*[@id='caixa-orange']/div[5]/a[2]/@href").extract()

        link = link[0]

        coor = link.split(':')

        coor = coor[2].split("+")

        yield {
            'cod': cod,
            'latidude': coor[0],
            'longitude': coor[1]
        }

class notas_patch(scrapy.Spider):
    name = "notas_patch"

    custom_settings = {
        'ITEM_PIPELINES': {
            'uniloc_crawler.pipelines.notas_patchPipeline': 400
        }
    }

    start_urls = [
        'https://dges.gov.pt/guias/indest.asp?reg=11',
        'https://dges.gov.pt/guias/indest.asp?reg=12',
        'https://dges.gov.pt/guias/indest.asp?reg=13',
        'https://dges.gov.pt/guias/indest.asp?reg=21',
        'https://dges.gov.pt/guias/indest.asp?reg=22'

    ]

    def parse(self, response):
        # .box9 é a classe que engloba os titulos de instituições
        for post in response.css('.box9'):

            cod_inst = post.css('div::text')[0].get()

            # seletor css para o proximo irmão (sibling)
            concat = " + .lin-ce "
            while(post.css('.box9 ' + concat).get() is not None):
                cod_curso = post.css('.box9 '+concat+' .lin-ce-c2::text').get()

                link = response.urljoin(
                    post.css('.box9 '+concat+' .lin-ce-c3 a::attr(href)').get())
                yield scrapy.Request(url=link, callback=self.parse_ult, meta={'curso': cod_curso, 'inst': cod_inst})

                concat = concat + " + .lin-ce "

    def parse_ult(self, response):
        curso = response.request.meta['curso']
        inst = response.request.meta['inst']

        try:
            notas = response.css(".body10a .tvag::text").getall()
            if notas[len(notas)-2] is not None and notas[len(notas)-2] != '\xa0':
                nota_ult_ER = notas[len(notas)-1]
            else:
                nota_ult_ER = "Informação não disponível"

            if notas[len(notas)-1] is not None and notas[len(notas)-1] != '\xa0':
                nota_ult_EN = notas[len(notas)-2]
            else:
                nota_ult_EN = "Informação não disponível"
            yield{
                'curso': curso,
                'inst': inst,
                'nota_ult_EN': nota_ult_EN,
                'nota_ult_ER': nota_ult_ER
            }
        except:
            yield{
                'curso': curso,
                'inst': inst,
                'nota_ult_EN': "Informação não disponível",
                'nota_ult_ER': "Informação não disponível"
            }