import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class ThreadValueVolatile implements Runnable {

    private static class ValueVolatile {

        private static volatile long value;

        public static long getValue() {
            return value;
        }

        public static void setValue(long value) {
            ValueVolatile.value = value;
        }

    }

    private String name;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public ThreadValueVolatile(String name) {
        this.setName(name);
    }

    public void run() {
        for (int i = 1; i < 6; i++) {
            long x = 1996199619961996L * i;
            ValueVolatile.getValue();
            System.out.println("Odczyt " + this.getName() + ": " + ValueVolatile.getValue());
            ValueVolatile.setValue(x);
            System.out.println("Zapis " + this.getName() + ": " + ValueVolatile.getValue());
        }
    }

    public static void main(String[] args) {
        ExecutorService executorService = Executors.newCachedThreadPool();
        executorService.execute(new ThreadValueVolatile("Watek 1"));
        executorService.execute(new ThreadValueVolatile("Watek 2"));
        executorService.shutdown();

    }

}