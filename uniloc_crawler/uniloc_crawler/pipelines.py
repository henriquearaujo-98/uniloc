# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://docs.scrapy.org/en/latest/topics/item-pipeline.html


# useful for handling different item types with a single interface
from itemadapter import ItemAdapter
import mysql.connector
import logging

class UnilocCrawlerPipeline:

    def open_spider(self, spider):
        self.create_connection()
        logging.info("\n\n OPENING SPIDER \n\n")
    
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
        self.curr.execute(""" INSERT INTO `instituicoes`(`ID`, `nome`) VALUES (%s,%s) """, (
            item['cod'],
            item['nome']
        ))

        self.conn.commit()
    
    def close_spider(self, spider):
        logging.info("\n\n CLOSING SPIDER \n\n")
        self.client.close()
