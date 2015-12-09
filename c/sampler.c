#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define BUFSIZE 256

int main(int argc, char *argv[]) {

  char msg[BUFSIZE];
  char character;
  size_t msgLen = BUFSIZE - 1;
  int i;
  int charValue;
  int sampleLength=5;
  
  // we will count all ascii characters, so 256 values max
  unsigned long long int frequency[256];
  unsigned long long int frequencyTotal = 0;

  for (i=0; i<256; i++) {
    frequency[i] = 0;
  }

  // This simply checks whether we managed to fill the buffer and tries to get
  // more input
  while (msgLen == (BUFSIZE - 1)) {
    memset (msg, '\0', BUFSIZE);
    fread(msg, BUFSIZE, 1, stdin);
    msg[BUFSIZE - 1] = '\0';
    msgLen = strlen(msg);
    for (i=0; i<BUFSIZE-1; i++) {

      // end of stream
      if (msg[i] == '\0') {
        break;
      }

      // update frequency array
      charValue = msg[i];
      if (charValue > 256) {
        printf("skipping non ascii character: %d \n", charValue);
	continue;
      }
      frequency[charValue]++;
      frequencyTotal++;
    }
    
    // the buffer is not filled? we must be finished
    if (msgLen < (BUFSIZE - 1))
      break;
  }

  // init msg to hold the resulting sample
  memset (msg, '\0', BUFSIZE);
  
  srand(time(NULL));
  for (i=0; i<sampleLength; i++) {

    // generate number between 0 and frequencyTotal
    unsigned long long int diceRoll = 0;
    unsigned long long int k;
    for (k=0; k*RAND_MAX < frequencyTotal; k++) {
	diceRoll += rand();
    }
    diceRoll %= frequencyTotal;

    // find the character the diceRoll represents in the frequency array
    int runner = 0;
    for (k=0; k < 256; k++) {
      runner += frequency[k];
      if (runner >= diceRoll && frequency[k] > 0) {
        frequency[k]--;
        frequencyTotal--;
        character = k;
        break;
      }
    }
    
    // append character to output var
    int len = strlen(msg);
    msg[len] = character;
    msg[len+1] = '\0';
  }

  puts(msg);

  return 0;

}
