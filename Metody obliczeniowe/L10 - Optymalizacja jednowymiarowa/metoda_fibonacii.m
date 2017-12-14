function[c] = metoda_fibonacii(a,b,n)
    format long g
    N=n+1;
    fold=1;
    fnew=1;
    func = inline(input('Podaj rownanie funkcji f(x): ','s'));
    f = zeros(1,N);
    for i = 1:N
        if i==1 || i==2
            f(i) = 1;
            continue;
        end
        f(i) = fold + fnew;
        fold = fnew;
        fnew = f(i);
    end
    L2 = (b-a) * f(N-2)/f(N);
    j = 2;
    while j<N
        L1 = (b-a);
        if L2 > L1/2
            anew = b - L2;
            bnew = a + L2;
        elseif L2<=L1/2
            anew = a + L2;
            bnew = b - L2;
        end
        k1 = func(anew);
        k2 = func(bnew);
        if k2 > k1
            b = bnew;
            L2 = f(N-j) * L1 / f(N-j+2);
        elseif k2 < k1
            a = anew;
            L2 = f(N-j) * L1 / f(N-(j-2));
        end
        j = j+1;
    end
    c = (a+b)/2;
end


