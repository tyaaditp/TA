from flask import render_template
from flask import request
from app import app

import numpy as np
import cv2
import os

@app.route('/')
@app.route('/index')
def hitung():
	
	parent_id = request.args.get('parent_id')

	path1 = request.args.get('path1')[1:].split('/')
	path2 = request.args.get('path2')[1:].split('/')
	path3 = request.args.get('path3')[1:].split('/')

	analisis1 = request.args.get('analisis1')
	analisis2 = request.args.get('analisis2')


	print (os.path.abspath(os.path.join(os.getcwd(), os.pardir, path1[0], path1[1] )))
	# Load an color image 
	a = cv2.imread(os.path.abspath(os.path.join(os.getcwd(), os.pardir, path1[0], path1[1] )))
	b = cv2.imread(os.path.abspath(os.path.join(os.getcwd(), os.pardir, path2[0], path2[1] )))
	c = cv2.imread(os.path.abspath(os.path.join(os.getcwd(), os.pardir, path3[0], path3[1] )))

	# tampilkan gambar


	# substrack image
	kurang1 = cv2.subtract(a,b)
	kurang2 = cv2.subtract(a,c)

	# konversi ke greyscale
	g1 =  cv2.cvtColor(kurang1, cv2.COLOR_BGR2GRAY)
	g2 =  cv2.cvtColor(kurang2, cv2.COLOR_BGR2GRAY)

	# konversi ke binary
	bin1,dst1 = cv2.threshold(g1,5,255,cv2.THRESH_BINARY)
	bin2,dst2 = cv2.threshold(g2,5,255,cv2.THRESH_BINARY)


	#imfill 

	th1, im_th1 = cv2.threshold(dst1, 220, 255, cv2.THRESH_BINARY_INV)

	im_floodfill1 = dst1.copy() 
	h1, w1 = dst1.shape[:2]
	mask1 = np.zeros((h1+2, w1+2), np.uint8)

	cv2.floodFill(im_floodfill1, mask1, (0,0), 255)
	im_floodfill_inv1 = cv2.bitwise_not(im_floodfill1)
	isi1 = dst1 | im_floodfill_inv1

		
	th2, im_th2 = cv2.threshold(dst2, 220, 255, cv2.THRESH_BINARY_INV)

	im_floodfill2 = dst2.copy() 

	h2, w2 = dst2.shape[:2]
	mask2 = np.zeros((h2+2, w2+2), np.uint8)

	cv2.floodFill(im_floodfill2, mask2, (0,0), 255)

	im_floodfill_inv2 = cv2.bitwise_not(im_floodfill2)

	isi2 = dst2 | im_floodfill_inv2




	#Memisahkan lingkaran, oval dan polygonal
		#citra1
	kernel = np.ones((10,10), np.uint8)
	lingb1 = cv2.erode(isi1, kernel, iterations=1) 
	lingb2 = cv2.dilate(lingb1, kernel, iterations=1)
		#citra2
	lingc1 = cv2.erode(isi2, kernel, iterations=1) 
	lingc2 = cv2.dilate(lingc1, kernel, iterations=1)



	#memisahkan garis
	strel1 = cv2.getStructuringElement(cv2.MORPH_ELLIPSE,(7,7))
	strel2 = np.ones((3,3), np.uint8)
		#citra1
	removegarisb = cv2.morphologyEx(isi1, cv2.MORPH_OPEN, strel1)
	garisb1 = isi1 - removegarisb
	garisb2 = cv2.erode(garisb1, strel2, iterations=1)
	garisb3 = cv2.dilate(garisb2, strel2, iterations=1)
		#citra2
	removegarisc = cv2.morphologyEx(isi2, cv2.MORPH_OPEN, strel1)
	garisc1 = isi2 - removegarisc
	garisc2 = cv2.erode(garisc1, strel2, iterations=1)
	garisc3 = cv2.dilate(garisc2, strel2, iterations=1)


	#memisahkan titik
	tik = cv2.getStructuringElement(cv2.MORPH_ELLIPSE,(3,3))
		#citra1
	titikb1 = isi1 - garisb3 - lingb2
	titikb2 = cv2.erode(titikb1, tik, iterations=1)
	titikb3 = cv2.dilate(titikb2, tik, iterations=1)
		#citra2
	titikc1 = isi2 - garisc3 - lingc2
	titikc2 = cv2.erode(titikc1, tik, iterations=1)
	titikc3 = cv2.dilate(titikc2, tik, iterations=1)


	#memisahkan oval



	# area irisan anotasi
	lingkarantotal = cv2.bitwise_and(lingb2, lingc2)
	titiktotal = cv2.bitwise_and(titikb3, titikc3)
	garistotal = cv2.bitwise_and(garisb3, garisc3)
	total = cv2.bitwise_and(isi1, isi2)


	# jumlah pixel anotasi
		#lingkaran
	pixelling1 = cv2.countNonZero(lingb2)
	pixelling2 = cv2.countNonZero(lingc2)
	pixellingTotal = cv2.countNonZero(lingkarantotal)
		#garis
	pixelgaris1 = cv2.countNonZero(garisb3)
	pixelgaris2 = cv2.countNonZero(garisc3)
	pixelgarisTotal = cv2.countNonZero(garistotal)
		#titik
	pixeltitik1 = cv2.countNonZero(titikb3)
	pixeltitik2 = cv2.countNonZero(titikc3)
	pixeltitikTotal = cv2.countNonZero(titiktotal)
		#Total
	pixelAnotasi1 = cv2.countNonZero(isi1)
	pixelAnotasi2 = cv2.countNonZero(isi2)
	pixelTotal = cv2.countNonZero(total)

	# cv2.imshow('image1',isi1)
	# cv2.imshow('image2',isi2)
	# cv2.imshow('image3',total)
	# cv2.waitKey(0)
	# cv2.destroyAllWindows()

	# jaccard 
		#lingkaran
	TL = pixelling1+pixelling2-pixellingTotal
	if TL != 0:
		presentaseling = ((pixellingTotal/(TL))*100)
		print ("ling:")
		print (round(presentaseling,2))
	else:
		presentaseling = 0
		print ("ling:")
		print (presentaseling)
		#titik
	TTK = pixeltitik1+pixeltitik2-pixeltitikTotal    
	if TTK != 0:
		presentasetitik = ((pixeltitikTotal/(TTK))*100)
		print ("titik:")
		print (round(presentasetitik,2))
	else:
		presentasetitik = 0
		print ("titik:")
		print (presentasetitik)  
		#garis
	TG = pixelgaris1+pixelgaris2-pixelgarisTotal
	if TG != 0:
		presentasegaris = ((pixelgarisTotal/(TG))*100)
		print ("garis:")
		print (round(presentasegaris,2))
	else:
		presentasegaris = 0
		print ("garis:")
		print (presentasegaris)  
		#total
	TT = pixelAnotasi1+pixelAnotasi2-pixelTotal
	if TT != 0:
		presentase = ((pixelTotal/(TT))*100)
		print ("total:")
		print (round(presentase,2))
	else:
		presentase = 0
		print ("total:")
		print (presentase)
		# jaccard
	
	return render_template('index.html', presentase=round(presentase,2),presentaseling=round(presentaseling,2),presentasetitik=round(presentasetitik,2),presentasegaris=round(presentasegaris,2),path1=path1[1], path2=path2[1],path3=path3[1],analisis1=analisis1,analisis2=analisis2,parent_id=parent_id )