function[F1, F2] = metoda_stirlinga(X,Y)
    n = size(X,2);
    T=zeros([size(X,2) size(X,2)+1]);
    T(:,1) = X;
    T(:,2) = Y;
    h = T(2,1)-T(1,1);
    disp('Krok: ');
    disp(h);
    fx = 0;
    fx2 = 0;
    for j=3:size(X,2)+1
        for i=size(X,2)-(j-2):-1:1
            T(i,j)=T(i+1,j-1)-T(i,j-1);
        end
    end
    disp('Tablica ró¿nic centralnych: ');
    disp(T);
    a=[1,-1/6,1/30];
    a2=[1,1/12,1/90];
    for i=2:2:n
        fx = fx + a(i/2)*(0.5*(T((((n-i)+1)/2),i+1)+T((((n-i)+1)/2+1),i+1)));
        fx2 = fx2 + a2(i/2)*(T((((n-i)+1)/2),i+2));
    end
    F1 = fx * 1/h;
    F2 = fx2 * 1/(h^2);
end