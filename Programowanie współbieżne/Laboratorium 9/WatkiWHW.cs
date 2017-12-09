using System;
using System.Threading;
namespace Zadanie_6 {
    class ThreadsSem {
        private static Semaphore semaphore = new Semaphore (1, 1, "Semafor");
        private static EventWaitHandle[] handlerStart;
        private static EventWaitHandle[] handlerEnd;
        static void Main () {
            Console.Write ("Podaj, ile wątków chcesz uruchomić: ");
            string consoleText = Console.ReadLine ();
            int threadNumber = 0;
            try {
                threadNumber = int.Parse (consoleText);
            } catch (Exception) {
                Console.WriteLine ("Konwersja tekstu na liczbę nie udała się!");
            }
            Console.WriteLine ("Liczba wątków do stworzenia: {0}", threadNumber);
            Thread[] threads = new Thread[threadNumber];
            handlerStart = new EventWaitHandle[threadNumber];
            handlerEnd = new EventWaitHandle[threadNumber];
            for (int i = 0; i < threadNumber; i++) {
                handlerStart[i] = new ManualResetEvent (false);
                handlerEnd[i] = new ManualResetEvent (false);
            }
            for (int i = 0; i < threadNumber; i++) {
                threads[i] = new Thread (new ParameterizedThreadStart (showSomething));
                threads[i].Name = "Wątek numer " + (i + 1).ToString ();
                threads[i].Start (i);
            }
            foreach (Thread thread in threads) {
                thread.Join ();
            }
        }
        static void showSomething (object obj) {
            int indeks = (int) obj;
            Console.WriteLine (Thread.CurrentThread.Name + " zaczyna pisać!");
            handlerStart[indeks].Set ();
            WaitHandle.WaitAll (handlerStart);
            Random random = new Random ();
            for (int i = 0; i < 3; i++) {
                semaphore.WaitOne ();
                Console.Write ("Ala");
                Thread.Sleep (random.Next (0, 100));
                Console.Write (" ma ");
                Thread.Sleep (random.Next (0, 100));
                Console.WriteLine ("kota numer " + (i + 1));
                Thread.Sleep (random.Next (0, 100));
                semaphore.Release ();
            }
            handlerEnd[indeks].Set ();
            WaitHandle.WaitAll (handlerEnd);
            Console.WriteLine (Thread.CurrentThread.Name + " skończył pisać!");
        }
    }
}