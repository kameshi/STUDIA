import java.util.Scanner;

public class SecantMethod {

    private static double[] x = new double[1000];
    private static double a;
    private static double b;
    private static double e;

    public static double baseFunction(double x) {
        return Math.pow(x, 3) + 1.6 * Math.pow(x, 2) - 5.47 * x + 2.21;
    }

    public static double firstDerivative(double x) {
        return 3 * Math.pow(x, 2) + 3.2 * x - 5.47;
    }

    public static double secondDerivative(double x) {
        return 6 * x + 3.2;
    }

    public static void enterData() {
        boolean end = false;
        while (!end) {
            try {
                System.out.println("### Program obliczający miejsca zerowe funkcji f(x)=x^3+1.6x^2-5.47x+2.21=0");
                System.out.println("\n");
                System.out.print("Wprowadź dolną granicę przedziału:");
                a = new Scanner(System.in).nextDouble();
                System.out.print("\nWprowadź górną granicę przedziału:");
                b = new Scanner(System.in).nextDouble();
                System.out.print("\nWprowadź wartość epsilon (dokładność):");
                e = new Scanner(System.in).nextDouble();
                end = true;
            } catch (Exception e) {
                System.out.println("\nWystapił błąd wpisywania danych!");
                for (int i = 0; i < 500; i++) {
                    System.out.println();
                }
            }
        }
    }

    public static void secantAlgorithm() {
        double z = (a + b) / 2;
        double f1 = firstDerivative(z);
        double f2 = secondDerivative(z);
        if (f1 * f2 < 0) {
            x[0] = a;
            x[1] = b;
        } else {
            System.out.println("\nIloczyn wartości pierwszej oraz drugiej pochodnej w przedziale [a,b] musi być ujemny!\n");
            enterData();
        }
        for (int i = 2; i < 1000; i++) {
            x[i] = x[i - 1] - baseFunction(x[i - 1]) * ((x[0] - x[i - 1]) / (baseFunction(x[0]) - baseFunction(x[i - 1])));
            if (Math.abs(baseFunction(x[i])) < e) {
                double result = x[i];
                System.out.println("\nPunkt zerowy w przedziale [" + a + "," + b + "]: " + result);
                break;
            }
        }
    }

    public static void main(String[] args) {
        SecantMethod.enterData();
        SecantMethod.secantAlgorithm();
    }


}
