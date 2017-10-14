#include <stdio.h>

int main(void)
{
	printf("Dziecko: %d\n",getpid());
	printf("Rodzic: %d\n",getppid());
	printf("Test getpgrp: %d\n",getpgrp());
	printf("Test setpgrp: %d\n",setpgrp());
	printf("Id użytkownika realne/efektywne: %d %d \n",getuid(),geteuid());
	printf("Id grupy realne/efektywne: %d %d \n",getgid(),getegid());
	return 0;
}
