#include <stdio.h>
#include <time.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/stat.h>

int main(int argc, char * argv[])
{
	int i=0;
	struct stat s;
	for(i=1;i<argc;i++)
	{
		if(stat(argv[i], &s)==-1)
		{
			perror("Wystapil blad");
			return 0;
		}
		else
		{
			printf("Ok! Nastepuje analiza pliku.\n");
		}

		printf("\n**** Plik: %s ***** \n\n",argv[i]);
		printf("Typ pliku:");
		if((s.st_mode & S_IFMT) == S_IFBLK)
		{
			printf("Urzadzenie blokowe\n");
		}
		if((s.st_mode & S_IFMT) == S_IFCHR)
		{
			printf("Urzadzenie znakowe\n");
		}
		if((s.st_mode & S_IFMT) == S_IFDIR)
		{
			printf("Katalog\n");
		}
		if((s.st_mode & S_IFMT) == S_IFIFO)
		{
			printf("Fifo\n");
		}
		if((s.st_mode & S_IFMT) == S_IFLNK)
		{
			printf("Link\n");
		}
		if((s.st_mode & S_IFMT) == S_IFREG)
		{
			printf("Plik regularny\n");
		}
		if((s.st_mode & S_IFMT) == S_IFSOCK)
		{
			printf("Gniazdo - socket\n");
		
		}

		printf("Dostep:\t");

		if(S_ISDIR(s.st_mode))
		{
			printf("d");
		}
		else printf("-");

		if(s.st_mode & S_IRUSR)
		{
			printf("r");
		}
		else printf("-");

		if(s.st_mode & S_IWUSR)
		{
			printf("w");
		}
		else printf("-");

		if(s.st_mode & S_IXUSR)
		{
			printf("x");
		}
		else printf("-");

		if(s.st_mode & S_IRGRP)
		{
			printf("r");
		}
		else printf("-");

		if(s.st_mode & S_IWGRP)
		{
			printf("w");
		}
		else printf("-");

		if(s.st_mode & S_IXGRP)
		{
			printf("x");
		}
		else printf("-");

		if(s.st_mode & S_IROTH)
		{
			printf("r");
		}
		else printf("-");

		if(s.st_mode & S_IWOTH)
		{
			printf("w");
		}
		else printf("-");

		if(s.st_mode & S_IXOTH)
		{
			printf("x");
		}
		else printf("-");

		printf("\nDostep: %o\n",s.st_mode);
		printf("Nr i-tego wezla: %ld\n",(unsigned long)s.st_ino);
		printf("Licznik odwolan: %ld\n",(unsigned long)s.st_nlink);
		printf("ID uzytkownika: %d\n", s.st_uid);
		printf("ID grupy: %d\n",s.st_gid);
		printf("Rozmiar bloku: %ld\n", (unsigned long)s.st_blksize);
		printf("Liczba przydzielonych blokow: %ld\n",s.st_blocks);
		printf("Rozmiar pliku: %ld\n",s.st_size);
		printf("Czas ostatniej zmiany stanu: %s",ctime(&s.st_ctime));
		printf("Czas ostatniego dostepu: %s", ctime(&s.st_atime));
		printf("Czas ostatniej modyfikacji: %s\n\n\n", ctime(&s.st_mtime));
	}
	return 0;
}
