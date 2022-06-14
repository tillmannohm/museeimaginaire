
import os, random, csv
path = os.getcwd()


for folder in sorted(os.listdir("images")):
    if folder != ".DS_Store":
        newCSV = []
        allJPG = []
        for file in os.listdir("images/"+folder):
            if file.endswith(".jpg"):
                allJPG.append(file)

        reader = csv.reader(open("csvs/"+folder+".csv", encoding='utf-8'))
        lines = [l for l in reader]
        for row in lines:
            for jpg in allJPG:
                try:
                    if jpg.replace(".jpg","") in row[4]:
                        newCSV.append(row)
                except:
                    pass

        with open("channels/"+folder+".csv", 'w', encoding='utf-8') as update:
            writer = csv.writer(update)
            for stuff in newCSV:
                writer.writerow(stuff)



slides = ""

for file in sorted(os.listdir("channels")):
    if file.endswith(".csv"):
        reader = csv.reader(open("channels/" + file, encoding='utf-8'))
        print(file)
        lines = [l for l in reader]

        counter=0
        interval = random.randint(3500,5500)

        for x in lines:
            link = x[2]
            pic = x[1]
            nam = file.replace(".csv","")
            print(nam)
            if counter == 0:
                slides += '''
                <div class="grid-item">

                <div id="''' + nam + '''" class="carousel slide" data-ride="carousel" data-interval="''' + str(interval) + '''" data-pause="false">
                <div class="overlay" id="loading ''' + nam + '''" style="display: block;">
                </div>
                   <div class="carousel-inner">
                     <div class="item ''' + nam + ''' active">
                     <a target="_blank" href="''' + link + '''"><img src="''' + pic + '''" /></a>
                     </div>
                '''
            else:
                slides += '''
                <div class="item ''' + nam + '''">
                <a target="_blank" href="''' + link + '''"><img src="''' + pic + '''" /></a>
                </div>
                '''

            counter += 1

        slides += '''</div></div></div>
        <script>$("#''' + nam + '''").on("slide.bs.carousel", function () {
        document.getElementById("loading ''' + nam + '''").style.display="none";
        });</script>'''


htmlContent = """
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Le #museeimaginaire</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  </head>
<body>
<link rel="stylesheet" href="css/bootstrap.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
strong {
  font-size: 120%;
}
p.a {
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
}
.overlay {
  bottom: 0;left: 0; top: 0; right: 0;
  height: 200px;
  width: 200px;
  margin: auto;
  position: absolute;
  background: url(loader.gif) center center;
  opacity:.60;
  z-index:1000;
}
.black_overlay{
	display: block;
	position: fixed;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: grey;
	z-index:1001;
	-moz-opacity: 0.9;
	opacity:.90;
	filter: alpha(opacity=90);
  cursor: pointer;
}
.white_content {
	display: block;
  position: relative;
  top: 0%;
  left: -50%;
	width: 536px;
	height: auto;
	padding: 18px;
	background-color: white;
	z-index:1002;
  cursor: pointer;
}
.grid-container {
	display:inline-block;
  max-width: 1500px;
  padding: 8px;
}
.grid-item {
  margin: 8px;
	height: 200px;
	width: 200px;
	float: left;
}
.carousel-inner {
	height: 200px;
	width: 200px;
}

</style>
<div style="position: relative; max-width: 1500px;">
<div style="position: absolute; left: 50%; top: 50px;">
<div id="light" class="white_content" a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'";>
<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><img src="museeimaginaire_500px.gif" /></a>
<div style="margin-top: 18px;">
  <p class="a" text-align="justify"><strong>Le #museeimaginaire</strong>
  <br><br>
Livestreams of popular artworks collectively reproduced by social media users.<br>
A contemporary virtual version of <em>Le Musée Imaginaire</em> - the imaginary museum.
<br><br>
Each artwork stream channels its latest representations from public Instagram posts
based on their physical locations using geotags. Aided by computer vision, every hour Le #museeimaginaire gathers shared auratic moments by museum visitors around the world in nearly real-time.
<br><br>
<strong>click to continue</strong></p><p class="a" align="right"><i>Tillmann Ohm</i></p>
</div>
</div>
</div>
</div>
<div id="fade" class="black_overlay" href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"/>
</div>
<div class="grid-container">
"""+ slides + """
</div>
</body>
</html>

"""

print(htmlContent)
with open("index_selected.html", "w") as f:
    f.write(htmlContent)
