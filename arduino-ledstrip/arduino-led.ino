#include <Adafruit_NeoPixel.h>

#define LED_COUNT 100
#define PIN 9

Adafruit_NeoPixel leds = Adafruit_NeoPixel(LED_COUNT, PIN, NEO_GRB + NEO_KHZ800);

int R = 255;
int G = 100;
int B = 150;
int brightness = 32;

// Function declaration
void clearLEDs();

void setup() {
  leds.begin();
  clearLEDs();
}

void loop() {
  for (int i = 0; i < LED_COUNT; i++) {
    leds.setPixelColor(i, random(0, 200), random(0, 190), random(0, 180));
    leds.setBrightness(brightness);
    leds.show();
    delay(50);
  }
}

void clearLEDs() {
  for (int i = 0; i < LED_COUNT; i++) {
    leds.setPixelColor(i,0);
    leds.show();
    delay(50);
  }
}
