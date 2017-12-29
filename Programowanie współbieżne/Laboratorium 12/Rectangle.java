public final class Rectangle implements Comparable<Rectangle> {

    private final double x;
    private final double y;
    private final double width;
    private final double height;
    private final double angle;

    private Rectangle(double x, double y, double height, double width, double angle) {
        this.x = x;
        this.y = y;
        this.height = height;
        this.width = width;
        this.angle = angle;
    }

    public double getX() {
        return x;
    }

    public double getY() {
        return y;
    }

    public double getWidth() {
        return width;
    }

    public double getHeight() {
        return height;
    }

    public double getAngle() {
        return angle;
    }

    public Rectangle changeAllProperties(Rectangle rectangle) {
        return new Rectangle(this.getX() + rectangle.x, this.getY() + rectangle.y, this.getHeight() + rectangle.height,
                this.getWidth() + rectangle.width, this.getAngle() + rectangle.angle);
    }

    public Rectangle changeX(double x) {
        return new Rectangle(x, y, height, width, angle);
    }

    public Rectangle changeY(double y) {
        return new Rectangle(x, y, height, width, angle);
    }

    public Rectangle changeHeight(double height) {
        return new Rectangle(x, y, height, width, angle);
    }

    public Rectangle changeWidth(double width) {
        return new Rectangle(x, y, height, width, angle);
    }

    public Rectangle rotate() {
        if (getAngle() + 90 == 360) {
            return new Rectangle(x, y, height, width, 0);
        } else {
            double newAngle = angle + 90;
            return new Rectangle(x, y, height, width, newAngle);
        }
    }

    @Override
    public String toString() {
        return "Rectangle{" +
                "x=" + x +
                ", y=" + y +
                ", width=" + width +
                ", height=" + height +
                ", angle=" + angle +
                '}';
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) {
            return true;
        }
        if (o == null || getClass() != o.getClass()) {
            return false;
        }

        Rectangle rectangle = (Rectangle) o;

        if (Double.compare(rectangle.getX(), getX()) != 0) {
            return false;
        }
        if (Double.compare(rectangle.getY(), getY()) != 0) {
            return false;
        }
        if (Double.compare(rectangle.getWidth(), getWidth()) != 0) {
            return false;
        }
        if (Double.compare(rectangle.getHeight(), getHeight()) != 0) {
            return false;
        }
        return Double.compare(rectangle.getAngle(), getAngle()) == 0;
    }

    @Override
    public int hashCode() {
        int result;
        long temp;
        temp = Double.doubleToLongBits(getX());
        result = (int) (temp ^ (temp >>> 32));
        temp = Double.doubleToLongBits(getY());
        result = 31 * result + (int) (temp ^ (temp >>> 32));
        temp = Double.doubleToLongBits(getWidth());
        result = 31 * result + (int) (temp ^ (temp >>> 32));
        temp = Double.doubleToLongBits(getHeight());
        result = 31 * result + (int) (temp ^ (temp >>> 32));
        temp = Double.doubleToLongBits(getAngle());
        result = 31 * result + (int) (temp ^ (temp >>> 32));
        return result;
    }

    @Override
    public int compareTo(Rectangle o) {
        if (this.getAngle() < o.getAngle()) {
            return -1;
        } else if (this.getAngle() == o.getAngle()) {
            return 0;
        } else {
            return 1;
        }
    }

    public static void main(String[] args) {
        Rectangle rectangle = new Rectangle(10, 20, 5, 5, 90);
        System.out.println(rectangle.toString());
        rectangle = rectangle.changeHeight(100);
        System.out.println(rectangle.toString());
        rectangle = rectangle.changeWidth(50);
        rectangle = rectangle.rotate();
        rectangle = rectangle.rotate();
        System.out.println(rectangle.toString());
        rectangle = rectangle.changeAllProperties(rectangle);
        System.out.println(rectangle.toString());
        Rectangle rectangle1 = new Rectangle(10,20,5,5,90);
        System.out.println("Test compareTo: " + rectangle1.compareTo(rectangle));
        System.out.println("Test equals: " + rectangle1.equals(rectangle));
        System.out.println("Test hashcode rectangle: " + rectangle.hashCode());
        System.out.println("Test hashcode rectangle1: " + rectangle1.hashCode());

        /* rectangle.height = 2; nie można */
        /* zmiana metody również zabroniona - bo klasa finalna to i metody finalne */
        /* w klasie, która dziedziczy po Rectangle też nie można implementować od nowa metod */
        /* tworzenie nowego obiektu i zmiana wielkości np. poprzez metodę, która zwraca zaktualizowany obiekt, itd. dozwolona*/

    }
}
