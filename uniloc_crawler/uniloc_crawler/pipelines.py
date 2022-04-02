# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://docs.scrapy.org/en/latest/topics/item-pipeline.html


# useful for handling different item types with a single interface
from itemadapter import ItemAdapter
import mysql.connector
import logging
import asyncio


class InformaçãoMunicipiosPipeline:

    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER INFORMAÇÕES MUNICIPIOS \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):

        # Mapear alguns municipios devido á sua repetição.
        # Como temos nomes repetidos quando fazemos a query á BD mais abaixo, atribui-mos aqui, de vez, o ID.
        if(item['municipio_nome'] == 'Calheta [R.A.A.]'):
            item['municipio_ID'] = 4501
            self.store_db(item)
            return
        
        if(item['municipio_nome'] == 'Calheta [R.A.M.]'):
            item['municipio_ID'] = 3101
            self.store_db(item)
            return
        
        if(item['municipio_nome'] == 'Lagoa [R.A.A.]'):
            item['municipio_ID'] = 4201
            self.store_db(item)
            return

        if(item['municipio_nome'] == 'Lagoa'):
            item['municipio_ID'] = '0806'
            self.store_db(item)
            return
        
        if(item['municipio_nome'] == 'Vila da Praia da Vitória'):
            item['municipio_nome'] = 'Praia da Vitória'

        
        asyncio.run(self.corotina(item))

        
        return item
    
    async def corotina(self, item):
        mun_id = await self.fetch_municipioID(item['municipio_nome'])

        if mun_id is None:
            return

        
        item['municipio_ID'] = str(mun_id[0])
        self.store_db(item)

    async def fetch_municipioID(self, municipio_nome):
        mydb = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='projeto_final'
        )

        mycursor = mydb.cursor()

        mycursor.execute("SELECT `ID` FROM `municipios` WHERE `nome` = '"+municipio_nome+"' ")

        myresult = mycursor.fetchone()

        return myresult

    def store_db(self, item):
        self.curr.execute(""" 
                            INSERT INTO `informacoes_municipios`
                                    (`municipio_ID`, 
                                    `População residente`, 
                                    `Densidade populacional`, 
                                    `Mulheres (%)`, 
                                    `Homens (%)`, 
                                    `Jovens (%)`, 
                                    `População em idade activa (%)`, 
                                    `Idosos (%)`, 
                                    `Índice de envelhecimento`, 
                                    `Indivíduos em idade activa por idoso`, 
                                    `Solteiros (%)`, 
                                    `Casados (%)`, 
                                    `Divorciados (%)`, 
                                    `Viúvos (%)`, 
                                    `Famílias`, 
                                    `Famílias unipessoais (%)`, 
                                    `Famílias com 2 pessoas (%)`, 
                                    `Alojamentos`, 
                                    `Alojamentos familiares clássicos (%)`, 
                                    `Alojamentos colectivos (%)`,
                                    `Alojamentos ocupados (%)`, 
                                    `Alojamentos próprios (%)`, 
                                    `Alojamentos próprios com encargos de compra (%)`, 
                                    `Alojamentos arrendados e outros casos (%)`, 
                                    `Renda mensal: <50€`,
                                    `Renda mensal: 50€ - 99,99€`,
                                    `Renda mensal: 100€ - 199,99€`,
                                    `Renda mensal: 200€ - 399,99€`,
                                    `Renda mensal: 400€ - 649,99€`,
                                    `Renda mensal: 650€ - 999,99€`,
                                    `Renda mensal: >=1000€`, 
                                    `Edificios`) 
                                     VALUES (%s,%s,%s,%s,%s,%s,%s, %s,%s, %s,%s, %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s, %s,%s,%s, %s,%s,%s,%s,%s) """, (
                                                item['municipio_ID'],                      
                                                item['População residente'],
                                                item['Densidade populacional'],
                                                item['Mulheres (%)'],
                                                item['Homens (%)'],
                                                item['Jovens (%)'],
                                                item['População em idade activa (%)'],
                                                item['Idosos (%)'],
                                                item['Índice de envelhecimento'],
                                                item['Indivíduos em idade activa por idoso'],
                                                item['Solteiros (%)'],
                                                item['Casados (%)'],
                                                item['Divorciados (%)'],
                                                item['Viúvos (%)'],
                                                item['Famílias'],
                                                item['Famílias unipessoais (%)'],
                                                item['Famílias com 2 pessoas (%)'],
                                                item['Alojamentos'],
                                                item['Alojamentos familiares clássicos (%)'],
                                                item['Alojamentos colectivos (%)'],
                                                item['Alojamentos ocupados (%)'],
                                                item['Alojamentos próprios (%)'],
                                                item['Alojamentos próprios com encargos de compra (%)'],
                                                item['Alojamentos arrendados e outros casos (%)'],
                                                item['Renda mensal: <50€'],
                                                item['Renda mensal: 50€ - 99,99€'],
                                                item['Renda mensal: 100€ - 199,99€'],
                                                item['Renda mensal: 200€ - 399,99€'],
                                                item['Renda mensal: 400€ - 649,99€'],
                                                item['Renda mensal: 650€ - 999,99€'],
                                                item['Renda mensal: >=1000€'],
                                                item['Edifícios'],

                                        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER INFORMAÇÕES MUNICIPIOS \n\n")
        self.client.close()


class InstituicoesPipeline:

    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER INSTITUICOES \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):
        self.store_db(item)
        return item

    def store_db(self, item):
        self.curr.execute(""" INSERT INTO `instituicoes`(`ID`, `nome`, `tipos_ensino_ID`,`cod_postal`) VALUES (%s,%s,%s,%s) """, (
            item['cod'],
            item['nome'],
            item['cod_tipo'],
            item['cod_postal']
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER INSTITUICOES \n\n")
        self.client.close()


class DistritosPipeline:

    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER DISTRITOS \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):
        if item['id'] and item['nome']:
            self.store_db(item)
            return item

    def store_db(self, item):
        self.curr.execute(""" INSERT INTO `distritos`(`ID`, `nome`) VALUES (%s,%s)""", (
            item['id'],
            item['nome'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER DISTRITOS \n\n")
        self.client.close()


class MunicipiosPipeline:

    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER MUNICIPIOS \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    # Apesar de enviarmos muitos registos com a PK duplicada devido á formatação do codigo postal, a BD só irá aceitar aqueles que não são duplicados, exatamente por serem PK
    # Efetuar uma query a todos os items seria mais demoro que deixar a BD lidar com a situação

    def process_item(self, item, spider):
        if item['nome'] and item['dist_id']:

            if(item['nome'] == 'Lisbon'):
                item['nome'] = 'Lisboa'

            if(item['nome'] == 'Bragança Municipality'):
                iten['nome'] = 'Bragança'


            self.store_db(item)
            return item

    def store_db(self, item):

        self.curr.execute(""" INSERT INTO `municipios`(`ID`, `nome`, `distritos_ID`) VALUES (%s,%s,%s)""", (
            item['mun_id'],
            item['nome'],
            item['dist_id'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER MUNICIPIOS \n\n")
        self.client.close()


class CodPostaisPipeline:

    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER CODIGOS POSTAIS \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    # Apesar de enviarmos muitos registos com a PK duplicada devido á formatação do codigo postal, a BD só irá aceitar aqueles que não são duplicados, exatamente por serem PK
    # Efetuar uma query a todos os items seria mais demoro que deixar a BD lidar com a situação

    def process_item(self, item, spider):

        if item['cidade'] and item['codigo_postal'] and item['cod_municipio']:
            asyncio.run(self.corotina(item))
            return item

    def store_db(self, item):

        self.curr.execute(""" INSERT INTO `codigos_postais`(`cod_postal`, `cidade_ID`) VALUES (%s,%s) """, (
            item['codigo_postal'][:4],
            item['cidade_id'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER CIDADES \n\n")
        self.client.close()
    
    async def corotina(self, item):
        cidade_id = await self.fetch_cidadeID(item['cidade'], item['cod_municipio'])

        if cidade_id is None:
            return

        
        item['cidade_id'] = str(cidade_id[0])
        self.store_db(item)

    async def fetch_cidadeID(self, cidade_nome, municipio_ID):
        mydb = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='projeto_final'
        )

        mycursor = mydb.cursor()

        mycursor.execute("SELECT `ID` FROM `cidades` WHERE `nome` = '"+cidade_nome+"' AND `municipio_ID` = '"+municipio_ID+"' ")

        myresult = mycursor.fetchone()

        return myresult


class CidadesPipeline:
    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER CIDADES \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    # Apesar de enviarmos muitos registos com a PK duplicada devido á formatação do codigo postal, a BD só irá aceitar aqueles que não são duplicados, exatamente por serem PK
    # Efetuar uma query a todos os items seria mais demoro que deixar a BD lidar com a situação

    def process_item(self, item, spider):

        if item['cidade'] and item['cod_municipio']:
            self.store_db(item)
            return item

    def store_db(self, item):

        self.curr.execute(""" INSERT INTO `cidades`(`nome`, `municipio_ID`) VALUES (%s,%s) """, (
            item['cidade'],
            item['cod_municipio'].strip(),
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER CIDADES \n\n")
        self.client.close()


class RankPipeline:
    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER Ranking \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):
        if item['rank'] is not None and item['nome'] is not None:
            self.store_db(item)
            return item

    def store_db(self, item):
        self.curr.execute(""" UPDATE `instituicoes` SET `Rank` = %s WHERE `nome` LIKE %s """, (
            item['rank'],
            item['nome'] + "%",
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER RANKING \n\n")
        self.client.close()


class ApartadosPipeline:
    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER APARTADOS \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    # Apesar de enviarmos muitos registos com a PK duplicada devido á formatação do codigo postal, a BD só irá aceitar aqueles que não são duplicados, exatamente por serem PK
    # Efetuar uma query a todos os items seria mais demoro que deixar a BD lidar com a situação

    def process_item(self, item, spider):

        if item['cod'] != 0 and item['nome']:
            nome = str(item['nome'])
            n = ''.join(x for x in nome if x.isalpha() or x == " ")
            # Upper case on every first letter of a word, no spaces in front, no spaces behind
            item['nome'] = n.title().lstrip().rstrip()
            asyncio.run(self.corotina(item))
            
            return item

    def store_db(self, item):

        self.curr.execute(""" INSERT INTO `codigos_postais`(`cod_postal`, `cidade_ID`) VALUES (%s,%s) """, (
            item['cod'],
            item['cidade_id'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER APARTADOS \n\n")
        self.client.close()
    
    async def corotina(self, item):
        mun_id = await self.fetch_municipioID(item['nome'])

        if mun_id is None:
            return

        
        item['cidade_id'] = str(mun_id[0])
        self.store_db(item)

    async def fetch_municipioID(self, cidade_nome):
        mydb = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='projeto_final'
        )

        mycursor = mydb.cursor()

        mycursor.execute(""" SELECT cidades.ID 
                            FROM `cidades`
                            INNER JOIN municipios ON municipios.ID = cidades.municipio_ID
                            WHERE cidades.nome = '"""+cidade_nome+"""' AND municipios.nome = '"""+cidade_nome+"""' """
                            )

        myresult = mycursor.fetchone()

        return myresult


class AreaPipeline:
    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER Area de Estudo \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):
        if item['codigo'] is not None and item['nome'] is not None:
            self.store_db(item)
            return item

    def store_db(self, item):
        self.curr.execute(""" INSERT INTO `area_estudo` (`ID`, `nome`) VALUES (%s, %s) """, (
            item['codigo'],
            item['nome'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER SPIDER Area de Estudo \n\n")
        self.client.close()


class CursosPipeline:

    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER Cursos \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):
        if item['cod'] is not None and item['curso'] is not None and item['cod_area'] is not None:
            self.store_db(item)
            return item

    def store_db(self, item):
        self.curr.execute(""" INSERT INTO `cursos` (`ID`, `nome`, `area_curso_ID`) VALUES (%s, %s, %s) """, (
            item['cod'],
            item['curso'],
            item['cod_area'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER SPIDER Cursos \n\n")
        self.client.close()


class Inst_CursosPipeline:

    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER Instituições por Cursos \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):
        if item['curso'] is not None and item['inst'] is not None:
            self.store_db(item)
            return item

    def store_db(self, item):
        self.curr.execute(""" INSERT INTO `instituicoes_has_curso` (`cursos_ID`, `instituicoes_ID`, `nota_ult_1fase`, `nota_ult_2fase`) VALUES (%s, %s, %s, %s) """, (
            item['curso'],
            item['inst'],
            item['nota_ult_EN'],
            item['nota_ult_ER'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER Instituições por Cursos \n\n")
        self.client.close()

class Provas_IngressoPipeline:

    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER PROVAS INGRESSO \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):

        if not item['curso_id'] or not item['inst_id']:
            return

        self.store_db(item)
        return item
       


    def store_db(self, item):

        self.curr.execute(""" INSERT INTO `provas_ingresso`( `cursoID`, `instituicoes_ID`, `exames_id`) VALUES (%s,%s,%s) """, (
            item['curso_id'],
            item['inst_id'],
            item['exames'],
        ))
 
        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO PROVAS INGRESSO \n\n")
        self.client.close()

class coordenadas_patchPipeline:
    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER COORDENADAS PATCH \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):
        self.store_db(item)
        return item

    def store_db(self, item):
        self.curr.execute(""" UPDATE `instituicoes` SET `latitude`= %s,`longitude`= %s WHERE `ID` = %s """, (
            item['latidude'],
            item['longitude'],
            item['cod'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO COORDENADAS PATCH \n\n")
        self.client.close()

class notas_patchPipeline:
    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n SPIDER PATCH NOTAS \n\n")

    def create_connection(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',
            passwd='',
            database='projeto_final'
        )
        self.curr = self.conn.cursor()

    def process_item(self, item, spider):
        if item['curso'] is not None and item['inst'] is not None:
            self.store_db(item)
            return item

    def store_db(self, item):
        self.curr.execute(""" UPDATE `instituicoes_has_curso` SET `nota_ult_1fase`=%s,`nota_ult_2fase`=%s WHERE `cursos_ID` = %s and `instituicoes_ID` = %s """, (
            item['nota_ult_EN'],
            item['nota_ult_ER'],
            item['curso'],
            item['inst'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO PATCH NOTAS \n\n")
        self.client.close()