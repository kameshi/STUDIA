import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class ThreadValueObject implements Runnable {

    private class ValueMethodObject {

        private volatile long value;

        public long increase() throws InterruptedException {
            synchronized (this) {
                if (value > 0) {
                    wait();
                }
                this.value++;
                notify();
                return value;
            }
        }

        public long decrease() throws InterruptedException {
            synchronized (this) {
                if (value < 1) {
                    wait();
                }
                this.value--;
                notify();
                return value;
            }
        }

    }

    private String name;

    private ValueMethodObject valueMethodObject = new ValueMethodObject();

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public ThreadValueObject(String name) {
        this.setName(name);
    }

    public void run() {
        for (int i = 1; i < 6; i++) {
            try {
                System.out.println(this.getName() + ": " + valueMethodObject.increase());
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
            try {
                System.out.println(this.getName()  + ": " + valueMethodObject.decrease());
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }
    }

    public static void main(String[] args) {
        ExecutorService executorService = Executors.newCachedThreadPool();
        executorService.execute(new ThreadValueObject("Watek 1"));
        executorService.execute(new ThreadValueObject("Watek 2"));
        executorService.shutdown();
    }

}