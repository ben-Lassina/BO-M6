#include <Adafruit_NeoPixel.h>

#define LED_COUNT 100
#define PIN 9
#define TRIG_PIN 7
#define ECHO_PIN 8
#define BUZZER_PIN 10 // Pin for the buzzer
#define MAX_DISTANCE 50  // Maximum distance in centimeters

Adafruit_NeoPixel leds = Adafruit_NeoPixel(LED_COUNT, PIN, NEO_GRB + NEO_KHZ800);

int R = 255;
int G = 100;
int B = 150;
int brightness = 32;

// Function declarations
void clearLEDs();
void colorWipe(uint32_t color, int wait);
void buzz(int frequency, long duration);

void setup() {
  leds.begin();
  clearLEDs();
  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);
  pinMode(BUZZER_PIN, OUTPUT); // Set the buzzer pin as output
}

void colorWipe(uint32_t color, int wait) {
  for (int i = 0; i < LED_COUNT; i++) {
    leds.setPixelColor(i, color);
  }
  leds.show();
  delay(wait);
}

void loop() {
  // Measure distance
  long duration, distance;
  digitalWrite(TRIG_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG_PIN, LOW);
  duration = pulseIn(ECHO_PIN, HIGH);
  distance = (duration / 2) / 29.1;  // Convert the time to distance in centimeters

  // Check if someone is within 50cm
  if (distance <= MAX_DISTANCE) {
    leds.setBrightness(brightness);
    colorWipe(leds.Color(213, 174, 23), 50);
    // Produce sound
    buzz(1000, 100); // Example buzz with 1000 Hz for 100 ms
  } else {
    // If no one is within 50cm, turn off the LEDs
    clearLEDs();
  }

  delay(100);  // Adjust the delay as needed for your application
}

void clearLEDs() {
  for (int i = 0; i < LED_COUNT; i++) {
    leds.setPixelColor(i, 0);
  }
  leds.show();
  delay(50);
}

void buzz(int frequency, long duration) {
  tone(BUZZER_PIN, frequency); // Generate sound at specified frequency
  delay(duration); // Sound duration
  noTone(BUZZER_PIN); // Stop the sound
}
