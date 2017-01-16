# -*- coding: utf-8 -*-
import serial
import time
import urlparse
import requests
import urllib

###interval odectu
interval=30;
###id zarizeni
equipment_id='587a223c5fe39569bb28e7bd';
###api key
api_key='none';
domain='http://localhost/fve';

########################################################################

#nastaveni portu
com = serial.Serial(port='/dev/ttyUSB0',
                        baudrate=600,
                        bytesize=serial.SEVENBITS,
                        parity=serial.PARITY_NONE,
                        stopbits=serial.STOPBITS_TWO,
                        timeout=5)
#metex magic
com.setRTS(False)
time.sleep(0.5)
com.setRTS(True)
time.sleep(0.5)
com.setRTS(False)

if com.isOpen():
    com.close()

com.open() 
while(True):
    #pozadavek na hodnotu
    com.write('D')
    #cteni radku
    s=com.readline()
    #parsovani hodnot
    r=' '.join(s.split()).split(' ')
    #naformátování uri
    data={'api-key':api_key,'meas':r[0],'value':float(r[1]),'unit':r[2]};
    query=urllib.urlencode(data);
    #odeslani uri
    r = requests.get(domain+"/send/"+equipment_id+"/?"+query)
    #vypis na obrazovku
    print 'Data: ' + str(data)
    print 'Odeslani dat: ' + str(r.status_code)
    #pockej na dalsi cteni
    time.sleep(interval)
com.close
