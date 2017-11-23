function[X] = metoda_gaussa(A,B)
    C = [A B.'];
    n = size(A,2);
    for s = 1:n-1
        for i = s+1:n
            for j = s+1:n+1
                C(i,j) = C(i,j) - C(i,s) / C(s,s) * C(s,j);
            end
        end
    end
    A = C(1:n,1:n);
    B = C(1:n,n+1);
    X = zeros([n 1]);
    X(n) = B(n) / A(n,n);
    for i = n-1:-1:1
        sum = 0;
        for s = i+1:n
            sum = sum + A(i,s) * X(s);
        end
        X(i) = (B(i) - sum) / A(i,i);
    end
end