using System;
using System.Threading;

class Watki {
    static int liczbaIteracji = 10;

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

        for (int licznik = 0; licznik < liczbaWatkow; licznik++) {
            tablicaWatkow[licznik] = new Thread (new ThreadStart (wyswietlajCos));
            tablicaWatkow[licznik].Name = "Wątek nr " + licznik.ToString ();
            tablicaWatkow[licznik].Start ();
        }

        foreach (Thread watek in tablicaWatkow) {
            watek.Join ();
        }
    }

    static void wyswietlajCos () {

        Console.WriteLine (Thread.CurrentThread.Name + " zaczyna pisać:");
        Random rand = new Random (Thread.CurrentThread.ManagedThreadId);
        for (int ii = 0; ii < liczbaIteracji; ii++) {
                Console.Write ("ala ");
                Thread.Sleep (rand.Next (0, 100));
                Console.Write ("ma ");
                Thread.Sleep (rand.Next (0, 100));
                Console.WriteLine ("kota " + ii);
                Thread.Sleep (rand.Next (0, 2000));
            }
        Console.WriteLine (Thread.CurrentThread.Name + " zakończył pisać.");
    }
}