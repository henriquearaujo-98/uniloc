# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://docs.scrapy.org/en/latest/topics/item-pipeline.html


# useful for handling different item types with a single interface
from itemadapter import ItemAdapter
import mysql.connector
import logging


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
        if item['nome'] and item['dist_id']:
            self.store_db(item)
            return item

    def store_db(self, item):

        self.curr.execute(""" INSERT INTO `cidades`(`nome`, `distritos_ID`, `qualidade`) VALUES (%s,%s,'N/A')""", (
            item['nome'],
            item['dist_id'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER CIDADES \n\n")
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

        if item['cod'] and item['nome']:
            self.store_db(item)
            return item

    def store_db(self, item):

        self.curr.execute(""" INSERT INTO `codigos_postais`(`cod_postal`, `cidades_nome`) VALUES (%s,%s) """, (
            item['cod'][:4],
            item['nome'],
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
            self.store_db(item)
            return item

    def store_db(self, item):

        self.curr.execute(""" INSERT INTO `codigos_postais`(`cod_postal`, `cidades_nome`) VALUES (%s,%s) """, (
            item['cod'],
            item['nome'],
        ))

        self.conn.commit()

    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER APARTADOS \n\n")
        self.client.close()


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
