import scrapy


class cursoCrawler(scrapy.Spider):
    name = "test"

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
        link = 'https://dges.gov.pt/guias/indcurso.asp?letra=' + self.next_alpha(next)
        if next:
            yield scrapy.Request(url=link, callback=self.parse)
       


        
            

       

            