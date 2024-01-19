//De tijd die we geven om de sensor aan te passen
int calibrationTime = 30;        

//the time when the sensor outputs a low impulse
long unsigned int lowIn;         

//De tijd dat de sensor op low staat in millisecondes
//Voordat we aannemen dat alles al gestopt is zetten we hier nog een pauze van 3 secondes
//om te checken of er nog motion wordt gedetecteerd
long unsigned int pause = 0;  

boolean lockLow = false;
boolean takeLowTime;  

int pirPin = 3;    //the digital pin gekoppeld aan de PIR sensor's output
int ledPin = 13;   //De pin waar het ledlampje aan gekoppeld is


//Hier wordt beschreven als de Serial begint, dat de PIR sensor de input is,
//en het ledlampje de output
//SETUP
void setup(){
  Serial.begin(115200);
  pinMode(pirPin, INPUT);
  pinMode(ledPin, OUTPUT);
  digitalWrite(pirPin, LOW);
  digitalWrite(ledPin, LOW);

  //De sensor de tijd nemen on aan te passen/calibrate
  Serial.print("calibrating sensor ");
    for(int i = 0; i < calibrationTime; i++){
      Serial.print(".");
      delay(1000);
      }
    Serial.println(" done");
    Serial.println("SENSOR ACTIVE");
    delay(50);
  }

////////////////////////////
//LOOP
void loop(){

     if(digitalRead(pirPin) == HIGH){
       digitalWrite(ledPin, HIGH);   //de led laat de sensor output zien
       if(lockLow){  
         //Zorgt ervoor dat we wachten voor de transitie, voordat er een andere output aangemaakt wordt
         lockLow = false;            
         Serial.println("---");
         Serial.print("motion detected at ");
         Serial.print(millis()/1000);
         Serial.println(" sec"); 
         delay(50);
         }         
         takeLowTime = true;
       }

     if(digitalRead(pirPin) == LOW){       
       digitalWrite(ledPin, LOW);  //De led leest hier de output van de LedPin variabele dat het niet aan is, of laag staat

       if(takeLowTime){
        lowIn = millis();          //Tijd besparen van de transitie van hoog naar laag
        takeLowTime = false;       //Ervoor zorgen dat de transitie alleen begint bij de start van een lage fase/LOW fase
        }
       //Als de sensor low is voor meer dan de gegeven pauze, 
       //We gaan hiervan uit dat er geen beweging gaat komen
       if(!lockLow && millis() - lowIn > pause){  
           //Zorgt ervoor dat deze blok code alleen maar wordt uitgevoerd nadat 
           //Een nieuwe beweging is gedetecteerd
           lockLow = true;                        
           Serial.print("motion ended at ");      //output
           Serial.print((millis() - pause)/1000);
           Serial.println(" sec");
           delay(50);
           }
       }
  }