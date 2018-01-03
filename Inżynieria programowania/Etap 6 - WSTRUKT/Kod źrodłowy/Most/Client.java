import java.time.LocalDateTime;

interface AddCause {
    void add(String name, String description);
}

abstract class Cause {
    protected AddCause causeToAdd;

    public Cause(AddCause causeToAdd) {
        this.causeToAdd = causeToAdd;
    }

    public abstract void addCause();
}

class CauseImplementation extends Cause {
    private String name;
    private String description;
    private LocalDateTime creationDate;
    private String status;

    public CauseImplementation(String name, String description, AddCause addCause) {
        super(addCause);
        this.name = name;
        this.description = description;
    }

    @Override
    public void addCause() {
        causeToAdd.add(name, description);
    }
}

class CauseAlimony implements AddCause {

    @Override
    public void add(String name, String description) {
        System.out.println("Dodano sprawę - alimenty: [NAZWA] " + name + " [OPIS]: " + description);
    }
}

class CauseBurglary implements AddCause {

    @Override
    public void add(String name, String description) {
        System.out.println("Dodano sprawę - włamanie: [NAZWA] " + name + " [OPIS]: " + description);
    }
}

class CauseMurder implements AddCause {

    @Override
    public void add(String name, String description) {
        System.out.println("Dodano sprawę - morderstwo: [NAZWA] " + name + " [OPIS]: " + description);
    }
}

class CauseTheft implements AddCause {

    @Override
    public void add(String name, String description) {
        System.out.println("Dodano sprawę - kradzież: [NAZWA] " + name + " [OPIS]: " + description);
    }
}

class CauseBeating implements AddCause {

    @Override
    public void add(String name, String description) {
        System.out.println("Dodano sprawę - pobicie: [NAZWA] " + name + " [OPIS]: " + description);
    }
}

public class Client {

    public static void main(String[] args) {

        Cause[] causes = new Cause[]{
                new CauseImplementation("Alimenty 020303", "OPIS ALIMENTY", new CauseAlimony()),
                new CauseImplementation("Pobicie 020303", "OPIS POBICIE", new CauseBeating()),
                new CauseImplementation("Włamanie 020303", "OPIS WLAMANIE", new CauseBurglary()),
                new CauseImplementation("Kradzież 020303", "OPIS KRADZIEZ", new CauseTheft()),
                new CauseImplementation("Morderstwo 020303", "OPIS MORDERSTWO", new CauseMurder())
        };

        for (Cause cause : causes) {
            cause.addCause();
        }
    }
}
