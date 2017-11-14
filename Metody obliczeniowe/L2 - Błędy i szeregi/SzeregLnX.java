import java.util.Scanner;

public class SzeregLnX {

	private static Double x;
	private static Integer n;
	private static Double wynik = 0D;
	private static Scanner s = new Scanner(System.in);

	public static Double getX() {
		return x;
	}

	public static void setX(Double x) {
		SzeregLnX.x = x;
	}

	public static Double getWynik() {
		return wynik;
	}

	public static void setWynik(Double wynik) {
		SzeregLnX.wynik = wynik;
	}

	public static Integer getN() {
		return n;
	}

	public static void setN(Integer n) {
		SzeregLnX.n = n;
	}

	public static void wprowadzX() {
		Double tmpX;
		Boolean koniec = false;
		while (!koniec) {
			try {
				System.out.print("Podaj wartosc x dla ktorej chcesz policzyc szereg (np. 0.3): ");
				tmpX = Double.parseDouble(s.next());
				if (tmpX <= -1 | tmpX > 1) {
					throw new Exception();
				} else {
					koniec = true;
					setX(tmpX);
				}
			} catch (Exception e) {
				System.out.println("Wartosc x musi nalezec do przedzialu (-1,1>!");
			}
		}
	}

	public static void wprowadzN() {
		Integer tmpN;
		Boolean koniec = false;
		while (!koniec) {
			try {
				System.out.print("Podaj wartosc ilosc iteracji (np. 10): ");
				tmpN = Integer.parseInt(s.next());
				if (tmpN < 1) {
					throw new Exception();
				} else {
					koniec = true;
					setN(tmpN);
				}
			} catch (Exception e) {
				System.out.println("Ilosc iteracji musi byc >=1!");
			}
		}
	}

	public static void obliczWartoscSzeregu() {
		for (int i = 1; i < getN(); i++) {
			setWynik(getWynik() + (Math.pow((-1), (i + 1)) / i) * Math.pow(x - 1, i));
		}
		System.out.println("Wynik szeregu ln(" + getX() + ")=sum[i=1,n=" + getN() + "] [((-1)^(i+1)/" + getN() + ") * ("
				+ getX() + "-1)^i] = " + getWynik());
	}

	public static void main(String[] args) throws Exception {
		SzeregLnX.wprowadzX();
		SzeregLnX.wprowadzN();
		SzeregLnX.obliczWartoscSzeregu();

	}
}
