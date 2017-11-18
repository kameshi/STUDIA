function[Fx] = metoda_taylora(X,Y,h,s)
    n = size(X,2);
    T = zeros(n,n+1);
    T(:,1) = X;
    T(:,2) = Y;
    tmpFx = 0;
    for i = 3:n+1
        for j = n-(i-2):-1:1
            T(j,i) = T(j+1,i-1) - T(j,i-1);
        end
    end
    if s==1
        for i = 3:n+1
            tmpFx = tmpFx + 1/(i-2) * T(n+(2-i),i);
        end
        Fx = (1/h) * tmpFx;
    end
    if s==2
        a=[1,1,11/12];
        for j = 4:n+1
            tmpFx = tmpFx + (a(j-n+2) * T(n+(2-j),j));
        end
        Fx = (1/(h^2)) * tmpFx;
    end
    if s==3
        a=[1,3/2,7/4,45/24];
        for j = 5:n+1
            disp(a(j-n+1));
            disp(T(n+(2-j),j));
            tmpFx = tmpFx + (a(j-n+1) * T(n+(2-j),j));
        end
        Fx = (1/(h^3)) * tmpFx;
    end
end