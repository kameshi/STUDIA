using System;
using System.Threading;

class Watki {
    static int liczbaIteracji = 5;
    static Semaphore sem = new Semaphore (1, 1, "Semafor");
    static EventWaitHandle[] start;
    static EventWaitHandle[] koniec;
    static void Main () {
        Console.WriteLine ("Podaj liczbę wątków:");
        string tekstZKonsoli = Console.ReadLine ();
        int liczbaWatkow = 0;

        try {
            liczbaWatkow = int.Parse (tekstZKonsoli);
        } catch (Exception ex) {
            Console.WriteLine ("Błąd konwersji podanego tekstu do liczby: " + ex.Message);
        }
        Console.WriteLine ("OK Stworzymy {0} wątków", liczbaWatkow);
        Thread[] tablicaWatkow = new Thread[liczbaWatkow];
        start = new EventWaitHandle[liczbaWatkow];
        koniec = new EventWaitHandle[liczbaWatkow];

        for (int licznik = 0; licznik < liczbaWatkow; licznik++) {
            start[licznik] = new ManualResetEvent (false);
            koniec[licznik] = new ManualResetEvent (false);
        }

        for (int licznik = 0; licznik < liczbaWatkow; licznik++) {
            tablicaWatkow[licznik] = new Thread (new ParameterizedThreadStart (wyswietlajCos));
            tablicaWatkow[licznik].Name = "Wątek nr " + licznik.ToString ();
            tablicaWatkow[licznik].Start (licznik);
        }

        foreach (Thread watek in tablicaWatkow) {
            watek.Join ();
        }
    }

    static void wyswietlajCos (object obj) {

        int indeks = (int)obj;
        Console.WriteLine (Thread.CurrentThread.Name + " zaczyna pisać:");
        start[indeks].Set ();
        WaitHandle.WaitAll (start);
        Random rand = new Random ();
        for (int ii = 0; ii < liczbaIteracji; ii++) {
            sem.WaitOne ();
            Console.Write ("ala ");
            Thread.Sleep (rand.Next (0, 100));
            Console.Write ("ma ");
            Thread.Sleep (rand.Next (0, 100));
            Console.WriteLine ("kota " + ii);
            Thread.Sleep (rand.Next (0, 100));
            sem.Release ();
        }
        koniec[indeks].Set ();
        WaitHandle.WaitAll (koniec);
        Console.WriteLine (Thread.CurrentThread.Name + " zakończył pisać.");
    }
}