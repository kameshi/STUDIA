import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class ThreadValueBlock implements Runnable {

    private class ValueBlock {

        private volatile long value;

        public long getValue() {
            synchronized (this) {
                return value;
            }

        }

        public void setValue(long value) {
            synchronized (this) {
                this.value = value;
            }
        }

    }

    private String name;

    private ValueBlock valueBlock = new ValueBlock();

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public ThreadValueBlock(String name) {
        this.setName(name);
    }

    public void run() {
        for (int i = 1; i < 6; i++) {
            long x = 1996199619961996L * i;
            valueBlock.getValue();
            System.out.println("Odczyt " + this.getName() + ": " + valueBlock.getValue());
            valueBlock.setValue(x);
            System.out.println("Zapis " + this.getName() + ": " + valueBlock.getValue());
        }
    }

    public static void main(String[] args) {
        ExecutorService executorService = Executors.newCachedThreadPool();
        executorService.execute(new ThreadValueBlock("Watek 1"));
        executorService.execute(new ThreadValueBlock("Watek 2"));
        executorService.shutdown();
    }

}