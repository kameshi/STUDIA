import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Zadanie1 {

    public void servicesNet() throws IOException, InterruptedException {
        ProcessBuilder builder = new ProcessBuilder();
        builder.command("net", "start");
        Process process = builder.start();
        BufferedReader reader = new BufferedReader(new InputStreamReader(process.getInputStream()));
        String line;
        while ((line = reader.readLine()) != null) {
            if (line.length() > 0) {
                System.out.println(line);
            }
        }
        process.waitFor();
    }

    public static void main(String[] args) {
        try {
            new Zadanie1().servicesNet();
        } catch (IOException e) {
            e.printStackTrace();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
    }
}
