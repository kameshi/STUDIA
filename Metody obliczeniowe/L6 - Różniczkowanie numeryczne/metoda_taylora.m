function[Fx] = metoda_taylora(X,Y,h)
    n = size(X,2);
    T = zeros(n,n+1);
    T(:,1) = X;
    T(:,2) = Y;
    tmpFx = 0;
    for i = 3:n+1
        for j = n-(i-2):-1:1
            T(j,i) = T(j+1,i-1) - T(j,i-1);
        end
        tmpFx = tmpFx + 1/(i-2) * T(size(X,2)+(2-i),i);
    end
    Fx = (1/h) * tmpFx;
end