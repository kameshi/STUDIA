public abstract class MandatDekorator implements MandatInterfejs {

    protected final MandatInterfejs mandat;

    public MandatDekorator(MandatInterfejs mandat) {
        this.mandat = mandat;
    }

    public void dodajNazwe() {
        mandat.dodajNazwe();
    }

    public void dodajKwote(Double koszt) {
        mandat.dodajKwote();
    }

    public void dodajWystawiajcego() {
        mandat.dodajWystawiajcego();

    }

    public void dodajOrgan() {
        mandat.dodajOrgan();
    }

    public void dodajPobierajacego() {
        mandat.dodajPobierajcego();
    }

    public void ustalTypMandatuPlatnosc() {
        mandat.ustalTypMandatuPlatnosc();
    }

    public void dodajPodstawePrawna() {
        mandat.dodajPodstawePrawna();
    }
}
