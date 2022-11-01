
#include <HTTPClient.h>
#include <WiFi.h>
#include <GravityTDS.h>
#include <ThingSpeak.h>

#define TdsSensorPin A0
#define VREF 0.66
#define SCOUNT  30

#define PIN1 16 // Defenisi Pin Relay Pompa TDS Nutrisi
#define PIN2 17 // Defenisi Pin Relay Pompa pH Down
#define PIN3 25 // Defenisi Pin Relay Pompa Air Baku
#define PIN4 26 // Defenisi Pin Relay Pompa pH Up

const int ph_Pin = A1;

const char* ssid = "KOST19_A";
const char* password = "12342210";
const char* host = "192.168.18.79";

const char *server = "api.thingspeak.com";
unsigned long myChanelNumber =1743141;
const char * myWriteAPIKey ="LBYS6S9V6972EUWV";

int analogBuffer[SCOUNT];
int analogBufferTemp[SCOUNT];
int analogBufferIndex = 0,copyIndex = 0;
float averageVoltage = 0, tdsValue = 0,temperature = 25;
WiFiClient client;

void setup()
{
    Serial.begin(115200);
    LightSensor.begin();
    pinMode(TdsSensorPin,INPUT);
    pinMode(ph_Pin, INPUT);
    ThingSpeak.begin(client);
    //Berikan mode pin untuk relay
    pinMode(PIN1, OUTPUT);
    pinMode(PIN2, OUTPUT);
    pinMode(PIN3, OUTPUT);
    pinMode(PIN4, OUTPUT);

    //Status awal mati/off
    digitalWrite(PIN1, LOW); //HIGH = 1, LOW =0 
    digitalWrite(PIN2, LOW); //HIGH = 1, LOW =0 
    digitalWrite(PIN3, LOW); //HIGH = 1, LOW =0 
    digitalWrite(PIN4, LOW); //HIGH = 1, LOW =0 
    
    WiFi.hostname("NodeMCU");
    WiFi.begin(ssid, password);
    //Cek Kondisi apakah berhasil atau tidak
    while (WiFi.status() != WL_CONNECTED)
    {
      //Mencoba koneksi Ke Jaringan WiFi
      Serial.println(".");
      delay(500);
    }
    //Apabila sudah terkoneksi Ke Jaringan WiFi
    Serial.println("Berhasil Connect Ke Jaringan WiFi");
}

void loop()
{
   static unsigned long analogSampleTimepoint = millis();
   if(millis()-analogSampleTimepoint > 40U)
   {
     analogSampleTimepoint = millis();
     // Membaca nilai analog dan simpan ke dalam buffer
     analogBuffer[analogBufferIndex] = analogRead(TdsSensorPin);    
     analogBufferIndex++;
     if(analogBufferIndex == SCOUNT) 
         analogBufferIndex = 0;
   }   
   static unsigned long printTimepoint = millis();
   if(millis()-printTimepoint > 800U)
   {
      printTimepoint = millis();
      for(copyIndex=0;copyIndex<SCOUNT;copyIndex++)
      analogBufferTemp[copyIndex]= analogBuffer[copyIndex];
      // Membaca nilai analog lebih stabil dengan algoritma penyaringan median, dan ubah ke nilai tegangan
      averageVoltage = getMedianNum(analogBufferTemp,SCOUNT) * (float)VREF / 1024.0;
      
      // Rumus kompensasi suhu: fFinalResult(25^C) = fFinalResult(saat ini)/(1.0+0.02*(fTP-25.0));
      float compensationCoefficient=1.0+0.02*(temperature-25.0);

      // Kompensasi suhu
      float compensationVolatge=averageVoltage/compensationCoefficient;  
      
      //mengubah nilai tegangan menjadi nilai tds
      tdsValue=(133.42*compensationVolatge*compensationVolatge*compensationVolatge - 255.86*compensationVolatge*compensationVolatge + 857.39*compensationVolatge)*0.5; 
      //Serial.print("voltage:");
      //Serial.print(averageVoltage,2);
      //Serial.print("V");
      Serial.print("Nilai TDS: ");
      Serial.print(tdsValue,0);
      Serial.println(" PPM");
      delay(15000);
   }
   
   ThingSpeak.writeField(myChanelNumber, 1, tdsValue, myWriteAPIKey);

   int nilai_analog_PH = analogRead(ph_Pin);
   Serial.print("Nilai ADC Ph: ");
   Serial.println(nilai_analog_PH);
   double TeganganpH = 0.66 / 1024.0 * nilai_analog_PH;
   Serial.print("Tegangan pH: ");
   Serial.println(TeganganpH);

   float phOutput = 0;

   // Untuk kalibrasi atur nilai voltage yang terbaca oleh sensor
   float PH4 = 3.1;
   float PH7 = 2.6;

   float Ph_step = (PH4 - PH7) / 0.66;
   phOutput = 7.0 + ((PH7 - TeganganpH) / Ph_step);
   Serial.print("Nilai PH Cairan: ");
   Serial.println(phOutput, 2);
   delay(15000);
   
   ThingSpeak.writeField(myChanelNumber, 2, phOutput, myWriteAPIKey);
   
   const int httpPort = 80;
   // Uji koneksi ke server apache
   if(!client.connect(host, httpPort))
   {
     Serial.println("Gagal Koneksi Ke Server Apache");
     return;
   } 
   Serial.println("Berhasil Koneksi Ke Server Apache"); 
   
   {
   // Baca jumlah cahaya yang diperoleh dari jam 8-16
   String LinkTDS, LinkRelayGrowlight, responseRelayGrowlight, LinkCahaya, LinkpH;
   HTTPClient httpsTDS, httppH, httpCahaya, httpRelayGrowlight, httpSPTH, httpSPTM, httpSPPHDH, httpSPPHDM, httpSPPHUH, httpSPPHUM, httpSGH, httpSGM;
   
   if(tdsValue < 600){
     // Kirim Status Pompa TDS Nutrisi Hidup ke Database MySQL
     float pth = 1;
     String LinkUSPTH="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimspth.php?status_pompaTH=" + String(pth);
     httpSPTH.begin(client, LinkUSPTH);
     httpSPTH.GET();
     httpSPTH.end();
     
     // Pompa nutrisi Menyala Selama 5 Detik
     digitalWrite(PIN1, HIGH);
     // Menyalakan Pompa Nutrisi Selama 5 Detik
     delay(5000);

     // Kirim Status Pompa TDS Nutrisi Hidup ke Database MySQL
     float ptm = 0;
     String LinkUSPTM="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimsptm.php?status_pompaTM=" + String(ptm);
     httpSPTM.begin(client, LinkUSPTM);
     httpSPTM.GET();
     httpSPTM.end();
     
     // Mematikan Pompa TDS Nutrisi
     digitalWrite(PIN1, LOW);
     
   } else if (tdsValue > 900) {
     // Kirim Status Pompa TDS Nutrisi Hidup ke Database MySQL
     float pth = 1;
     String LinkUSPTH="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimspth.php?status_pompaTH=" + String(pth);
     httpSPTH.begin(client, LinkUSPTH);
     httpSPTH.GET();
     httpSPTH.end();
     
     // Pompa nutrisi Menyala Selama 5 Detik
     digitalWrite(PIN3, HIGH);
     // Menyalakan Pompa Nutrisi Selama 5 Detik
     delay(5000);

     // Kirim Status Pompa TDS Nutrisi Hidup ke Ke Server
     float ptm = 0;
     String LinkUSPTM="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimsptm.php?status_pompaTM=" + String(ptm);
     httpSPTM.begin(client, LinkUSPTM);
     httpSPTM.GET();
     httpSPTM.end();
     
     // Mematikan Pompa TDS Nutrisi
     digitalWrite(PIN3, LOW);
   }

   //Pengiriman Data TDS Ke Server
   LinkTDS="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimdatatds.php?sensor=" + String(tdsValue);
   httpsTDS.begin(client, LinkTDS);
   httpsTDS.GET();
   httpsTDS.end();

   //Pengiriman Nilai pH Ke Server
   LinkpH="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimdataph.php?sensorph=" + String(phOutput);
   httppH.begin(client, LinkpH);
   httppH.GET();
   httppH.end();

   
   Serial.print("Nilai pH Nutrisi: ");
   Serial.println(phOutput);
   if (phOutput > 7) {
     // Kirim Status Pompa ph Down Hidup ke Database MySQL
     float ppdh = 1;
     String LinkUSPPDH="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimsppdh.php?status_pompapHDH=" + String(ppdh);
     httpSPPHDH.begin(client, LinkUSPPDH);
     httpSPPHDH.GET();
     httpSPPHDH.end();
     
     // Pompa pH Down Menyala Selama 5 Detik
     digitalWrite(PIN2, HIGH);
     // Mengisi pH Up selama 5 detik
     delay(5000);
     
     // Kirim Status Pompa ph Down Mati ke Database MySQL
     float ppd = 0;
     String LinkUSPPD="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimsppd.php?status_pompapHDM=" + String(ppd);
     httpSPPHDM.begin(client, LinkUSPPD);
     httpSPPHDM.GET();
     httpSPPHDM.end();

     digitalWrite(PIN2, LOW);
   }
   else if (phOutput < 6) {
     // Kirim Status Pompa ph Up Hidup ke Database MySQL
     float ppuh = 1;
     String LinkUSPPUH="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimsppuh.php?status_pompapHUH=" + String(ppuh);
     httpSPPHUH.begin(client, LinkUSPPUH);
     httpSPPHUH.GET();
     httpSPPHUH.end();
      
     // Pompa pH Up Menyala Selama 5 Detik
     // Ubah Status Relay di nodemcu
     digitalWrite(PIN5, HIGH);
     // Mengisi pH Up selama 5 detik
     delay(5000);
     
     // Kirim Status Pompa pH up ke Database MySQL, ppu=pompa pH Up
     float ppu = 0;
     String LinkUSPPU="http://"+String(host)+"/HidroponikWMF/hidroponik/pegawai/kirimsppu.php?status_pompapHUM=" + String(ppu);
     httpSPPHUM.begin(client, LinkUSPPU);
     httpSPPHUM.GET();
     httpSPPHUM.end();

     digitalWrite(PIN5, LOW);
   }
  }
}

int getMedianNum(int bArray[], int iFilterLen) 
{
      int bTab[iFilterLen];
      for (byte i = 0; i<iFilterLen; i++)
      bTab[i] = bArray[i];
      int i, j, bTemp;
      for (j = 0; j < iFilterLen - 1; j++) 
      {
      for (i = 0; i < iFilterLen - j - 1; i++) 
          {
        if (bTab[i] > bTab[i + 1]) 
            {
        bTemp = bTab[i];
            bTab[i] = bTab[i + 1];
        bTab[i + 1] = bTemp;
         }
      }
      }
      if ((iFilterLen & 1) > 0)
    bTemp = bTab[(iFilterLen - 1) / 2];
      else
    bTemp = (bTab[iFilterLen / 2] + bTab[iFilterLen / 2 - 1]) / 2;
      return bTemp;
}
