function[C] = metoda_stirlinga(X,Y,h)
    n = size(X,2);
    T=zeros([size(X,2) size(X,2)+1]);
    T(:,1) = X;
    T(:,2) = Y;
    fx = 0;
    for j=3:size(X,2)+1
        for i=size(X,2)-(j-2):-1:1
            T(i,j)=T(i+1,j-1)-T(i,j-1);
        end
    end
    disp(T);
    a=[1,-1/6,1/30];
    for i=2:2:n
        disp(i);
        fx = fx + a(i/2)*(0.5*(T((((n-i)+1)/2),i+1)+T((((n-i)+1)/2+1),i+1)));
    end
    C = fx * 1/h;
end