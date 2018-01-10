import java.time.LocalDateTime;

public class Klient {
    public static void main(String[] args)
    {
        MandatInterfejs mandat = new Mandat(1L,220.25," ", LocalDateTime.now()," ", " ", " ");
        mandat = new FotoradarDekorator(new PunktyKarneDekorator(new DrogaSadowaDekorator(new GlownyTypMandatuDekorator(mandat))));
    }
}
