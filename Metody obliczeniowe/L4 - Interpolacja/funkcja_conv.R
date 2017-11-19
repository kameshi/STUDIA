function.conv <- function(U,V)
{
  m<-length(U)
  n<-length(V)
  t<-c()
  for(k in 1:m+n)
  {
    t=0.0
    for(j in 0:m)
    {
      if((k-j)>=1 && (k-j)<=n)
      {
        t=c(t)+(U[j+1]*V[k-j])
        print(t)
      }
    }
    w=c(w)+c(t);
  }
  return (w)
}



