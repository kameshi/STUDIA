function[C] = metoda_stirlinga(X,Y,h,s)
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
    a2=[1,1/12,1/90];
    if s==1
        for i=2:2:n
            fx = fx + a(i/2)*(0.5*(T((((n-i)+1)/2),i+1)+T((((n-i)+1)/2+1),i+1)));
        end
        C = fx * 1/h;
    end
    if s==2
        fx=0;
        for i=2:2:n
            fx = fx + a2(i/2)*(T((((n-i)+1)/2),i+2));
        end
        C = fx * 1/(h^2);
    end
end