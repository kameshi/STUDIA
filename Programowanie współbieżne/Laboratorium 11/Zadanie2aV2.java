import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Zadanie2aV2 implements Runnable {

    @Override
    public void run() {
        ProcessBuilder builder = new ProcessBuilder();
        builder.command("net", "start");
        Process process = null;
        try {
            process = builder.start();
        } catch (IOException e) {
            e.printStackTrace();
        }
        BufferedReader reader = new BufferedReader(new InputStreamReader(process.getInputStream()));
        String line;
        try {
            while ((line = reader.readLine()) != null) {
                if (line.length() > 0) {
                    System.out.println(line);
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
    }

    public static void main(String[] args) {
        new Thread(new Zadanie2aV2()).start();
    }

}