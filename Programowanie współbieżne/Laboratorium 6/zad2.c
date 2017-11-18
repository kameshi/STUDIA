#include <sys/types.h>
#include <sys/ipc.h>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>

/*
a) Zmienić nazwę programu i uruchomić, jakie dostaliśmy identyfikatory?

Takie same, dla char proj = 3 zwraca 0x3010003.

b) Zmienić nr projektu lub/i ścieżkę, porównać otrzymane wyniki:

Wyniki różnią się:
    dla char proj = 3 zwraca 0x3010003.
    dla char proj = 4 zwraca 0x4010003.
*/

int main(void)
{
    key_t klucz;
    klucz = ftok("/tmp/",4);
    printf("ftok: 0x%X\n",klucz);
    return 0;
}