import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class ThreadValueMethodSync implements Runnable {

    private static class ValueMethodSync {

        private static volatile long value;

        public synchronized static long getValue() {
            return value;
        }

        public synchronized static void setValue(long value) {
            ValueMethodSync.value = value;
        }

    }

    private String name;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public ThreadValueMethodSync(String name) {
        this.setName(name);
    }

    public void run() {
        for (int i = 1; i < 6; i++) {
            long x = 1996199619961996L * i;
            ValueMethodSync.getValue();
            System.out.println("Odczyt " + this.getName() + ": " + ValueMethodSync.getValue());
            ValueMethodSync.setValue(x);
            System.out.println("Zapis " + this.getName() + ": " + ValueMethodSync.getValue());
        }
    }

    public static void main(String[] args) {
        ExecutorService executorService = Executors.newCachedThreadPool();
        executorService.execute(new ThreadValueMethodSync("Watek 1"));
        executorService.execute(new ThreadValueMethodSync("Watek 2"));
        executorService.shutdown();
    }

}