package a;

import java.util.Scanner;

public class CalkaTrapezSimpson {

	private static Double a;
	private static Double b;
	private static Integer n;
	private static Double wynikTrapez = 0D;
	private static Double wynikSimpson = 0D;
	private static Scanner s = new Scanner(System.in);

	public static Double getA() {
		return a;
	}

	public static void setA(Double a) {
		CalkaTrapezSimpson.a = a;
	}

	public static Double getB() {
		return b;
	}

	public static void setB(Double b) {
		CalkaTrapezSimpson.b = b;
	}

	public static Integer getN() {
		return n;
	}

	public static void setN(Integer n) {
		CalkaTrapezSimpson.n = n;
	}

	public static Double getWynikTrapez() {
		return wynikTrapez;
	}

	public static void setWynikTrapez(Double wynikTrapez) {
		CalkaTrapezSimpson.wynikTrapez = wynikTrapez;
	}

	public static Double getWynikSimpson() {
		return wynikSimpson;
	}

	public static void setWynikSimpson(Double wynikSimpson) {
		CalkaTrapezSimpson.wynikSimpson = wynikSimpson;
	}

	public static void wprowadzDane() {
		Boolean koniec = false;
		String tmpA;
		String tmpB;
		String tmpN;
		while (!koniec) {
			try {
				System.out.println("Podaj wartosc granice dolna, granice gorna calkowania oraz ilosc podprzedzialow.");
				System.out.print(">> Dolna granica (a): ");
				tmpA = s.next();
				System.out.print(">> Gorna granica (b): ");
				tmpB = s.next();
				System.out.print(">> Ilosc podprzedzialow (n): ");
				tmpN = s.next();
				setA(Double.parseDouble(tmpA));
				if (tmpB.equals("pi/2")) {
					setB(Math.PI / 2);
				} else {
					setB(Double.parseDouble(tmpB));
				}
				setN(Integer.parseInt(tmpN));
				if (getA() > getB() || getN() < 2) {
					throw new Exception();
				} else {
					koniec = true;
				}
			} catch (Exception e) {
				System.out.println("\n[Wyjatek]: Blad! Sprobuj ponownie! Blad wpisania lub blad matematyczny: a<b oraz n>2!\n");
			}
		}

	}

	public static Double funkcja(Double x) {
		Double wynik = Math.sqrt(1 + 0.6 * Math.sin(x));
		return wynik;
	}

	public static void trapezCalka() {
		Double h = (getB() - getA()) / getN();
		for (int i = 1; i < getN(); i++) {
			setWynikTrapez(getWynikTrapez() + funkcja(a + i * h));
		}
		setWynikTrapez(h * (getWynikTrapez() + (funkcja(a) + funkcja(b)) / 2));
		System.out.println("\n[Metoda trapezow - wynik]: " + getWynikTrapez());
	}

	public static void simpsonCalka() {
		Double h = (getB() - getA()) / getN();
		try {
			if ((getN() & 1) != 0) {
				throw new Exception();
			} else {
				setWynikSimpson(funkcja(a) + funkcja(b));
				for (int i = 1; i < getN(); i++) {
					if ((i & 1) == 0) {
						setWynikSimpson(getWynikSimpson() + 2 * funkcja(a + i * h));
					} else {
						setWynikSimpson(getWynikSimpson() + 4 * funkcja(a + i * h));
					}
				}
			}
		} catch (Exception e) {
			System.out.println("\n[Metoda Simpsona - wyjatek!]: Ilosc podprzedzialow dla metody Simpsona musi byc liczba parzysta!");
			System.exit(-1);
		}
		setWynikSimpson((h * getWynikSimpson()) / 3);
		System.out.println("\n[Metoda Simpsona - wynik]: " + getWynikSimpson());
	}

	public static void main(String[] args) {
		wprowadzDane();
		trapezCalka();
		simpsonCalka();
	}

}
