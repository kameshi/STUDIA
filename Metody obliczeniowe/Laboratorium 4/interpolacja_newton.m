function[C] = interpolacja_newton(X,Y)
    n = length(X);
    D = zeros(n,n);
    D(:,1) = Y';
    for i=2:size(X,2)
        for j=i:size(X,2)
            D(j,i) = (D(j,i-1)-D(j-1,i-1))/(X(j)-X(j-i+1));
        end
    end
    C = D(n,n);
    for k=(n-1):-1:1
        C = conv(C,poly(X(k)));
        m = length(C);
        C(m) = C(m) + D(k,k);
    end
end