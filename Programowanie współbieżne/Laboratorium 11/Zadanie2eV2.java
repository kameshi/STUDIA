import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.TimeUnit;

public class Zadanie2eV2 implements Runnable{

    @Override
    public void run(){
        try {
            TimeUnit.SECONDS.sleep(1);
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        ProcessBuilder builder = new ProcessBuilder();
        builder.command("net", "start");
        Process process = null;
        try {
            process = builder.start();
        } catch (IOException e) {
            e.printStackTrace();
        }
        ArrayList<String> tab = new ArrayList<>();
        BufferedReader reader = new BufferedReader(new InputStreamReader(process.getInputStream()));
        String line;
        try {
            while ((line = reader.readLine()) != null) {
                if (line.length() > 0) {

                    tab.add(line);
                }
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        try {
            process.waitFor();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        System.out.println(Arrays.toString(tab.toArray()));
    }

    public static void main(String[] args)
    {
        ExecutorService executor = Executors.newCachedThreadPool();
        executor.execute(new Zadanie2eV2());
        executor.execute(new Zadanie2eV2());
        executor.execute(new Zadanie2eV2());
        executor.execute(new Zadanie2eV2());
        executor.execute(new Zadanie2eV2());
        executor.execute(new Zadanie2eV2());
        executor.execute(new Zadanie2eV2());
        executor.shutdown();

    }
}

