# coding: utf-8
try:
    #ブラウザ利用設定
    from selenium import webdriver
    browser = webdriver.Chrome()
    #csv抽出設定
    import pandas as pd
    df = pd.DataFrame()
    

    #1募集ページ一覧にてclass名から募集URL全部取り出す
    browser.get('https://www.wantedly.com/companies/www-jbakk-co/projects')
    elems_url = browser.find_elements_by_class_name('ProjectCard__Upper-af8oak-1')

    #2空配列を作る
    keys = []

    #3一つずつ配列に入れる
    for elem_url in elems_url:
        key = elem_url.get_attribute("href")
        keys.append(key)


    #4取り出したURLを元にページ要素を取得する *空だった場合に備える
    titles = []
    spcounts = []
    totalviews = []
    encounts = []

    for key in keys:
        browser.get(key)
        if(browser.find_elements_by_class_name('project-title')) == []:
            titles.append('0')
        else:
            title = browser.find_element_by_class_name('project-title').text
            titles.append(title)
        if(browser.find_elements_by_class_name('wt-support-count')) == []:
            spcounts.append('0')
        else:
            spcount = browser.find_element_by_class_name('wt-support-count').text
            spcounts.append(spcount)
        if(browser.find_elements_by_class_name('total-views')) == []:
            totalviews.append('0')
        else:
            totalview = browser.find_element_by_class_name('total-views').text
            totalviews.append(totalview)
        if(browser.find_elements_by_class_name('entry-count')) == []:
            totalviews.append('0')
        else:
            encount = browser.find_element_by_class_name('entry-count').text
            encounts.append(encount)


    df['募集タイトル'] = titles
    df['応援数'] = spcounts
    #df['PV数'] = totalviews
    #df['応募数'] = encounts

    df.to_csv('url1.csv',index=False)
except Exception as e:
    print(e)