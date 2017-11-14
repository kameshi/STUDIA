function[C] = metoda_strilinga(X,Y,h)
    T=zeros([size(X,2) size(X,2)+1]);
    T(:,1) = X;
    T(:,2) = Y;
    fx = 0;
    for j=3:size(X,2)+1
        for i=size(X,2)-(j-2):-1:1
            T(i,j)=T(i+1,j-1)-T(i,j-1);
        end
    end
    C = T;
    % DO ROZKMINY %
    %a=[1,-1/6,1/30];
    %for i=2:size(X,2)+1:2
        %fx=fx+a(i/2-1)*(T((size(X,2)-1+1)/2-1,i)+T((size(X,2)-i+1)/2,i))/2;
    %end
    %C = fx * 1/h;
end
    
    
