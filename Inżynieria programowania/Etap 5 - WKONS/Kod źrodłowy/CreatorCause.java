public class CreatorCause {

    public CauseMurder createCauseMurder() {
        return new CauseMurder();
    }

    public CauseAlimony createCauseAlimony() {
        return new CauseAlimony();
    }

    public CauseBeating createCauseBeating() {
        return new CauseBeating();
    }

    public CauseBurglary createCauseBurglary() {
        return new CauseBurglary();
    }

    public CauseTheft createCauseTheft() {
        return new CauseTheft();
    }

    public static Cause createObject(Cause.objectType objectType) throws IllegalArgumentException {
        switch (objectType) {
            case Murder:
                return new CauseMurder();
            case Alimony:
                return new CauseAlimony();
            case Burglary:
                return new CauseBeating();
            case Beating:
                return new CauseBurglary();
            case Theft:
                return new CauseTheft();
        }
        throw new IllegalArgumentException();
    }
}
