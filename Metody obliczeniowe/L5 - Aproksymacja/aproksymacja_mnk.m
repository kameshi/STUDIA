function[Q] = aproksymacja_mnk(X,Y)
    m=1;
    n=size(X,2);
    S=zeros([1 2*m+1]);
    T=zeros([1 m+1]);
    TMP=zeros([m+1 m+2]);
    a=min(X)-2;
    b=max(X)+2;

    % GŁÓWNY ALGORYTM:
    for i=1:2*m+1
        for j=1:n
            S(i)=S(i)+X(j)^(i-1);
        end
    end
    for i=1:m+1
        for j=1:n
            T(i)=T(i)+X(j).^(i-1)*Y(j);
        end
    end
    for i=1:m+1
        for j=1:m+1
            TMP(j,i)=S(1,j+i-1);
        end
    end
    TMP(1:m+1,m+2) = T;
    A=TMP(1:m+1,1:m+1);
    B=TMP(1:m+1,m+2);
    Q=A\B;

    % WYKRESOWE OBLICZENIA:
    XX=a:b;
    YY=zeros([1 size(XX,2)]);
    for i=1:size(XX,2)
        for j=1:size(Q,1)
            YY(i)=YY(i)+Q(j)*XX(i)^(j-1);
        end
    end

    % RYSOWANIE WYKRESU:
    plot(X,Y,'o',XX,YY);
    title("APROKSYMACJA");
    xlabel("X");
    ylabel("Y");
end
    
            
   