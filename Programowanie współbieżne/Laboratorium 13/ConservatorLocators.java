import java.time.LocalDateTime;
import java.util.Random;
import java.util.concurrent.*;

class ConfigurationThreads {

    private static final int MAX_TIME_REPAIR = 5;
    private static final int LOCATORS = 10;
    private static final int SLEEP_TIME_LOCATORS = 20;
    private static final float FAULT_PROPABILITY = 0.3f;

    public static int getMaxTimeRepair() {
        return MAX_TIME_REPAIR;
    }

    public static int getLOCATORS() {
        return LOCATORS;
    }

    public static int getSleepTimeLocators() {
        return SLEEP_TIME_LOCATORS;
    }

    public static float getFaultPropability() {
        return FAULT_PROPABILITY;
    }
}

class MessageNotification {
    private String description;
    private LocalDateTime notificationDate;

    public MessageNotification(String description, LocalDateTime notificationDate) {
        this.description = description;
        this.notificationDate = notificationDate;
    }

    public String getDescription() {
        return description;
    }

    @Override
    public String toString() {
        return "Usterka [" +
                "opis='" + description + '\'' +
                ", data=" + notificationDate +
                ']';
    }
}

class Conservator implements Runnable {

    private BlockingQueue<MessageNotification> blockingQueue;

    public Conservator(BlockingQueue<MessageNotification> blockingQueue) {
        this.blockingQueue = blockingQueue;
        System.out.println("[KONSERWATOR] Oczekuje na zgłoszenie...");
    }

    @Override
    public void run() {

        while (true) {
            try {
                MessageNotification messageNotification = blockingQueue.take();
                System.out.println("[PRZYJETO ZGLOSZENIE]: " + messageNotification);
                TimeUnit.SECONDS.sleep(new Random().nextInt(ConfigurationThreads.getMaxTimeRepair()));
                System.out.println("[NAPRAWIONO]: " + messageNotification);
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }


    }
}

class Locator implements Runnable {

    private int FlatNumber;
    private BlockingQueue<MessageNotification> blockingQueue;

    public Locator(int flatNumber, BlockingQueue<MessageNotification> blockingQueue) {
        FlatNumber = flatNumber;
        this.blockingQueue = blockingQueue;
    }

    @Override
    public void run() {
        while (true) {

            int maxValue = 10 / Math.round(ConfigurationThreads.getFaultPropability() * 10);
            int value = new Random().nextInt(maxValue);
            if (value == 0) {
                String description = "[AWARIA] Mieszkanie numer: " + this.FlatNumber;
                try {
                    blockingQueue.put(new MessageNotification(description, LocalDateTime.now()));
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
                System.out.println("[MIESZKANIEC] Zgłaszam awarię w mieszkaniu numer: " + this.FlatNumber);
            }
            try {
                TimeUnit.SECONDS.sleep(ConfigurationThreads.getSleepTimeLocators());
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }
    }
}

public class ConservatorLocators {

    public static void main(String[] args) {
        ExecutorService executorService = Executors.newCachedThreadPool();
        BlockingQueue<MessageNotification> blockingQueue = new ArrayBlockingQueue<>(1000);
        executorService.execute(new Conservator(blockingQueue));
        for (int i = 0; i < ConfigurationThreads.getLOCATORS(); i++) {
            executorService.execute(new Locator(i, blockingQueue));
        }
        executorService.shutdown();

    }
}
