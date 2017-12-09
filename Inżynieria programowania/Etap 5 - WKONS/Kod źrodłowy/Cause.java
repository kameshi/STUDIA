import java.time.LocalDateTime;

public abstract class Cause {

    public enum objectType {
        Murder,
        Alimony,
        Burglary,
        Beating,
        Theft,
    }

    public Integer id;
    public String name;
    public String description;
    public String status;
    public LocalDateTime creationDate;
    public LocalDateTime statusChangeDate;
    public objectType objectType;

    public abstract void addName();

    public abstract void addDescription();

    public abstract Integer getId();

    public abstract void setId(Integer id);

    public abstract String getName();

    public abstract void setName(String name);

    public abstract String getDescription();

    public abstract void setDescription(String description);

    public abstract String getStatus();

    public abstract void setStatus(String status);

    public abstract LocalDateTime getCreationDate();

    public abstract void setCreationDate(LocalDateTime creationDate);

    public abstract LocalDateTime getStatusChangeDate();

    public abstract void setStatusChangeDate(LocalDateTime statusChangeDate);

    public abstract Cause.objectType getObjectType();

    public abstract void setObjectType(Cause.objectType objectType);

}
