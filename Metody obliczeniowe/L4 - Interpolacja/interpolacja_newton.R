function.newton <- function(X,Y)
{
  n<-length(X)
  D<-matrix(0,n,n)
  D[,1]<- t(Y)
  for(i in 2:size(X,2))
  {
    for(j in i:size(X,2))
    {
      D[j,i]=(D[j,i-1]-D[j-1,i-1])/(X[j]-X[j-i+1])
    }
  }
  C<-D[n,n]
  for(k in (n-1):1)
  {
    C<-c(conv(C,Poly(X[k])))
    m<-length(C)
    C[m] <- c(C[m]+D[k,k])
  }
  return (C)
}