import java.time.LocalDateTime;

public class CauseAlimony extends Cause {

    public CauseAlimony() {
        this.objectType = objectType.Alimony;
    }

    @Override
    public void addName() {
    }

    @Override
    public void addDescription() {
    }

    @Override
    public Integer getId() {
        return id;
    }

    @Override
    public void setId(Integer id) {
        this.id = id;
    }

    @Override
    public String getName() {
        return name;
    }

    @Override
    public void setName(String name) {
        this.name = name;
    }

    @Override
    public String getDescription() {
        return description;
    }

    @Override
    public void setDescription(String description) {
        this.description = description;
    }

    @Override
    public String getStatus() {
        return status;
    }

    @Override
    public void setStatus(String status) {
        this.status = status;
    }

    @Override
    public LocalDateTime getCreationDate() {
        return creationDate;
    }

    @Override
    public void setCreationDate(LocalDateTime creationDate) {
        this.creationDate = creationDate;
    }

    @Override
    public LocalDateTime getStatusChangeDate() {
        return statusChangeDate;
    }

    @Override
    public void setStatusChangeDate(LocalDateTime statusChangeDate) {
        this.statusChangeDate = statusChangeDate;
    }

    @Override
    public Cause.objectType getObjectType() {
        return objectType;
    }

    @Override
    public void setObjectType(Cause.objectType objectType) {
        this.objectType = objectType;
    }

}
