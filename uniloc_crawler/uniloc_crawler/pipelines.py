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
            host = 'localhost',
            user = 'root',
            passwd = '',
            database = 'projeto_final'
        )
        self.curr = self.conn.cursor()
    
    def process_item(self, item, spider):
        self.store_db(item)
        return item

    def store_db(self, item):
        self.curr.execute(""" INSERT INTO `instituicoes`(`ID`, `nome`, `tipos_ensino_ID`) VALUES (%s,%s,%s) """, (
            item['cod'],
            item['nome'],
            item['cod_tipo']
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
            host = 'localhost',
            user = 'root',
            passwd = '',
            database = 'projeto_final'
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
        logging.info("\n\n SPIDER DISTRITOS \n\n")
    
    def create_connection(self):
        self.conn = mysql.connector.connect(
            host = 'localhost',
            user = 'root',
            passwd = '',
            database = 'projeto_final'
        )
        self.curr = self.conn.cursor()
    

    # Apesar de enviarmos muitos registos com a PK duplicada devido á formatação do codigo postal, a BD só irá aceitar aqueles que não são duplicados, exatamente por serem PK
    # Efetuar uma query a todos os items seria mais demoro que deixar a BD lidar com a situação
    def process_item(self, item, spider):

        if item['cod'] and item['dist_cod'] and item['nome']:
            item['cod'] = item['cod'][:4] # Obter apenas os primeiros 4 digitos
            self.store_db(item)
            return item
            

    def store_db(self, item):
        
        self.curr.execute(""" INSERT INTO `cidades`(`cod_postal`, `nome`, `distritos_ID`) VALUES (%s,%s,%s)""", (
            item['cod'],
            item['nome'],
            item['dist_cod']
        ))

        self.conn.commit()
    
    def close_spider(self, spider):
        logging.info("\n\n FECHANDO SPIDER DISTRITOS \n\n")
        self.client.close()

    







