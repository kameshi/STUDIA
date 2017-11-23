function[X] = metoda_cramera(A,B)
    n = size(A,2);
    W1 = zeros(n,n);
    W2 = zeros(n,n);
    W3 = zeros(n,n);
    W = A;
    W1(:,1) = B;
    W1(:,2) = A(:,2);
    W1(:,3) = A(:,3);
    W2(:,1) = A(:,1);
    W2(:,2) = B;
    W2(:,3) = A(:,3);
    W3(:,1) = A(:,1);
    W3(:,2) = A(:,2);
    W3(:,3) = B;
    x1 = det(W1)/det(W);
    x2 = det(W2)/det(W);
    x3 = det(W3)/det(W);
    X = [x1 x2 x3].';
end
    
    
