import scrapy


class InformaçãoCidades_Spider(scrapy.Spider):

    name = "test"

    start_urls = [
       'https://www.pordata.pt/Municipios/Quadro+Resumo/Odivelas-255941'
    ]

    base_link = 'https://www.pordata.pt/Municipios/Quadro+Resumo/'

    def parse(self, response):

        index = 1

        inf = dict()
        inf['cidade'] = 'Odivelas'

        for reg in response.css('#QrTable tr'):
            
            
            try:
                indicador = response.xpath('//*[@id="QrTable"]/tbody/tr['+str(index)+']/td[1]/div[2]/a/text()').extract()[0]
                valor = response.xpath('//*[@id="QrTable"]/tbody/tr['+str(index)+']/td[11]/text()').extract()[0]
            except:
                continue


            # Porque estamos a sacar os indicadores do ciclo foreach e o valor de um offset de uma lista, temos um bug onde um indicador se duplica
            # Isto causa que os valores - indicadores estajam desalinhados por 1
            if indicador is None:
                continue

            
            inf[indicador] = valor

            index += 1

        
        yield inf
       


        
            

       

            