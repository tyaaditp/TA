from flask import render_template
from flask import request
from app import app

import numpy as np
import cv2
import os

@app.route('/')
@app.route('/index')
def hitung():

	path1 = request.args.get('path1')
	path2 = request.args.get('path2')
	path3 = request.args.get('path3')

	# Load an color image 
	a = cv2.imread(os.path.abspath(os.path.join(os.getcwd(), os.pardir, path1)))
	b = cv2.imread(os.path.abspath(os.path.join(os.getcwd(), os.pardir, path2)))
	c = cv2.imread(os.path.abspath(os.path.join(os.getcwd(), os.pardir, path3)))

	# tampilkan gambar


	# substrack image
	kurang1 = cv2.subtract(a,b)
	kurang2 = cv2.subtract(a,c)

	# konversi ke greyscale
	g1 =  cv2.cvtColor(kurang1, cv2.COLOR_BGR2GRAY)
	g2 =  cv2.cvtColor(kurang2, cv2.COLOR_BGR2GRAY)

	# konversi ke binary
	bin1,dst1 = cv2.threshold(g1,10,255,cv2.THRESH_BINARY)
	bin2,dst2 = cv2.threshold(g2,10,255,cv2.THRESH_BINARY)

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

	# area irisan anotasi
	total = cv2.bitwise_and(isi1, isi2)

	# jumlah pixel anotasi
	pixelAnotasi1 = cv2.countNonZero(isi1)
	pixelAnotasi2 = cv2.countNonZero(isi2)
	pixelTotal = cv2.countNonZero(total)

	# cv2.imshow('image1',isi1)
	# cv2.imshow('image2',isi2)
	# cv2.imshow('image3',total)
	# cv2.waitKey(0)
	# cv2.destroyAllWindows()

	# jaccard 
	presentase = ((pixelTotal/(pixelAnotasi1+pixelAnotasi2-pixelTotal))*100)
	return render_template('index.html', presentase=presentase,path1=path1, path2=path2,path3=path3 )