# pip install google
# pip install beautifulsoup4
from itemadapter import ItemAdapter
import mysql.connector
import time
import logging
import json

try:
    from googlesearch import search
except ImportError:
    print("No module named 'google' found")


mydb = mysql.connector.connect(
    host='localhost',
    user='root',
    password='',
    database='projeto_final'
)

mycursor = mydb.cursor()

mycursor.execute("SELECT i.nome as inst, c.nome AS curso, cursos_ID, instituicoes_ID FROM instituicoes_has_curso ic INNER Join instituicoes i ON i.ID = ic.instituicoes_ID INNER JOIN cursos c ON c.ID = ic.cursos_ID ")

myresult = mycursor.fetchall()

for x in myresult:
    NomeEscola = x[0]
    NomeCurso = x[1]
    IdCurso = x[2]
    IdEscola = x[3]
    print(x)

    query = NomeEscola + NomeCurso + " plano de estudos"

    print("IdEscola", IdEscola, "\n IdCurso", IdCurso, "\n", query)

    time.sleep(1)

    for url in search(query, tld="co.in", num=1, stop=1, pause=2):
        mycursor.execute(""" UPDATE `instituicoes_has_curso` SET `plano_curso`= %s WHERE `cursos_ID` = %s And `instituicoes_ID` = %s """, (
            url,
            IdCurso,
            IdEscola,
        ))

        mydb.commit()

        print("\n", url)
        print("\nUpdate Succeed\n\n\n")

        time.sleep(1)


mycursor.close()
mydb.close()

# num: Number of results we want.
# stop: The last result to retrieve. Use None to keep searching forever.
# pause: Lapse to wait between HTTP requests. Lapse too short may cause Google to block your IP.
# Keeping significant lapses will make your program slow but it’s a safe and better option.
