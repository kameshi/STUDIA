import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.lang.reflect.Array;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.concurrent.*;

public class Zadanie2cV2 implements Callable<String>{
    @Override
    public String call(){
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
        return Arrays.toString(tab.toArray());
    }

    public static void main(String[] args) throws ExecutionException, InterruptedException {
        ExecutorService service = Executors.newSingleThreadExecutor();
        for(int i=0;i<5;i++)
        {
            Future<String> future = service.submit(new Zadanie2cV2());
            System.out.println(future.get());
        }
        service.shutdown();
    }
}
