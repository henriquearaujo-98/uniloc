import scrapy
from scrapy.crawler import CrawlerProcess


#Lista de instituições e os seus respetivos cursos
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
        #.box9 é a classe que engloba os titulos de instituições
        for post in response.css('.box9'):

            # Por cada instituição, criamos um dicionario para todos os seus cursos
            cursos = list()
            
            concat = " + .lin-ce " # seletor css para o proximo irmão (sibling)

            #Sintetizamos um bloco do while
            # curso['nome'] = post.css('.box9 '+concat+' a::text' ).get()
            # cursos.append(curso)
            # concat = concat + " + .lin-ce "

            while(post.css('.box9 '+ concat  ).get() is not None):
                curso = dict()
                curso['cod'] = post.css('.box9 '+concat+' .lin-ce-c2::text' ).get()
                curso['nome'] = post.css('.box9 '+concat+' .lin-ce-c3 a::text' ).get()

                cursos.append(curso)
                concat = concat + " + .lin-ce "
                

            yield {
                'cod': post.css('div::text')[0].get(),
                'nome': post.css('div::text')[1].get(),
                'cod_tipo' : response.url[-2:],
                'cursos' : cursos
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
        #.box9 é a classe que engloba os titulos de instituições
        for post in response.css('.box9'):
            yield {
                'cod': post.css('div::text')[0].get(),
                'nome': post.css('div::text')[1].get(),
                'cod_tipo' : response.url[-2:],
            }

# Popular a tabela cursos
class cursoCrawler(scrapy.Spider):
    name = "cursos"

    start_urls = [
        'https://dges.gov.pt/guias/indcurso.asp?letra=A',
    ]

    def next_alpha(self, s):
        return chr((ord(s.upper())+1 - 65) % 26 + 65)

    def parse(self, response):
        #.box9 é a classe que engloba os titulos de instituições
        for post in response.css('.box10'):
            yield {
                'cod': post.css('div::text')[0].get(),
                'nome': post.css('div::text')[1].get(),
            }
        
        next = response.request.url[-1] # Mudamos um A para o B
        link = "https://dges.gov.pt/guias/indcurso.asp?letra=" + self.next_alpha(next)
        if next:
            yield scrapy.Request(url=link, callback=self.parse)

# Popular a tabela associativa inst_curso
class inst_cursoCrawler(scrapy.Spider):
    name = "inst_curso"

    start_urls = [
        'https://dges.gov.pt/guias/indest.asp?reg=11',
        'https://dges.gov.pt/guias/indest.asp?reg=12',
        'https://dges.gov.pt/guias/indest.asp?reg=13',
        'https://dges.gov.pt/guias/indest.asp?reg=21',
        'https://dges.gov.pt/guias/indest.asp?reg=22'

    ]

    def parse(self, response):
        #.box9 é a classe que engloba os titulos de instituições
        for post in response.css('.box9'):

            cod_inst = post.css('div::text')[0].get()
            
            concat = " + .lin-ce " # seletor css para o proximo irmão (sibling)
            while(post.css('.box9 '+ concat  ).get() is not None):
                cod_curso = post.css('.box9 '+concat+' .lin-ce-c2::text' ).get()

                link = response.urljoin(post.css('.box9 '+concat+' .lin-ce-c3 a::attr(href)' ).get())
                yield scrapy.Request(url = link, callback=self.parse_ult, meta={'curso' : cod_curso, 'inst' : cod_inst})
                
                concat = concat + " + .lin-ce "

    
    def parse_ult(self, response):
        curso = response.request.meta['curso']
        inst = response.request.meta['inst']

        try:
            notas = response.css(".body10a .tvag::text").getall()
            if notas[len(notas)-2] is not None:
                nota_ult_ER = notas[len(notas)-1]
            else:
                nota_ult_ER = "Informação não disponível"

            if notas[len(notas)-1] is not None:
                nota_ult_EN = notas[len(notas)-1]
            else:
                nota_ult_EN = "Informação não disponível"
            yield{
                'curso': curso,
                'inst': inst,
                'nota_ult_EN': nota_ult_EN,
                'nota_ult_ER' : nota_ult_ER
            }
        except:
             yield{
                'curso': curso,
                'inst': inst,
                'nota_ult_EN': "Informação não disponibilizada",
                'nota_ult_ER' : "Informação não disponibilizada"
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
                    'nome' : row.css("a::text").get(),
                    'id' : row.css("td.gras::text").get()
                }


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


        
            

       

            
            