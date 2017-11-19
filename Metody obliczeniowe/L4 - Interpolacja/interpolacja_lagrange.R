function.lagrange <- function(X,Y) 
{
  C <- c(0);
  for(i in 1:length(X))
  {
    P <- c(1)
    for(j in 1:length(X))
    {
      if (j!=i)
      {
        W <- c(1,-X[j])
        P <- c(conv(P,W))/(X[i]-X[j])
      }
    }
    C <- c(C + Y[i] * P)
  }
  return (C);
}






