import java.util.Scanner;

public class Gauss {

    private static double[][] A;
    private static double[] B;
    private static double[] result;
    private static double x;
    private static double sum;
    private static int N;
    private static int max;
    private static Scanner in = new Scanner(System.in);

    public static void enterData() {
        boolean end = false;
        while (!end) {
            try {
                System.out.print("Wprowadź ilość niewiadomych: ");
                N = Integer.parseInt(in.next());
                A = new double[N][N];
                B = new double[N];
                System.out.println("Wprowadź " + N + " współczynników równań:");
                for (int i = 0; i < N; i++) {
                    for (int j = 0; j < N; j++) {
                        A[i][j] = Double.parseDouble(in.next());
                    }
                }
                System.out.println("Wprowadź " + N + " wyrazy wynikowe:");
                for (int i = 0; i < N; i++) {
                    B[i] = Double.parseDouble(in.next());
                }
                end = true;
            } catch (Exception e) {
                System.out.println("[BŁĄD] BŁĘDNIE WPISANO DANE!\n");
                for (int i = 0; i < 500; i++) {
                    System.out.println();
                }
            }
        }
    }

    public static void methodGauss() {
        N = B.length;
        for (int s = 0; s < N; s++) {
            max = s;
            for (int i = s + 1; i < N; i++) {
                if (Math.abs(A[i][s]) > Math.abs(A[max][s])) {
                    max = i;
                }
            }
            double[] tempA = A[s];
            A[s] = A[max];
            A[max] = tempA;
            double tempB = B[s];
            B[s] = B[max];
            B[max] = tempB;
            for (int i = s + 1; i < N; i++) {
                x = A[i][s] / A[s][s];
                B[i] -= x * B[s];
                for (int j = s; j < N; j++) {
                    A[i][j] -= x * A[s][j];
                }
            }
        }
        result = new double[N];
        for (int i = N - 1; i >= 0; i--) {
            sum = 0.0;
            for (int s = i + 1; s < N; s++) {
                sum += A[i][s] * result[s];
            }
            result[i] = (B[i] - sum) / A[i][i];
        }
    }

    public static void printResult() {
        N = result.length;
        System.out.println("Wynik: ");
        for (int i = 0; i < N; i++) {
            System.out.println("x" + i + ": " + result[i]);
        }
    }

    public static void main(String[] args) {
        Gauss.enterData();
        Gauss.methodGauss();
        Gauss.printResult();
    }
}